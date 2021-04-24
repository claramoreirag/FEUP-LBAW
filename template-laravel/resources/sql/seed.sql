DROP TABLE IF EXISTS category CASCADE;
DROP TABLE IF EXISTS follow_category CASCADE;
DROP TABLE IF EXISTS source CASCADE;
DROP TABLE IF EXISTS post CASCADE;
DROP TABLE IF EXISTS saved_post CASCADE;
DROP TABLE IF EXISTS post_source CASCADE;
DROP TABLE IF EXISTS post_vote CASCADE;
DROP TABLE IF EXISTS comment CASCADE;
DROP TABLE IF EXISTS report CASCADE;
DROP TABLE IF EXISTS follow CASCADE;
DROP TABLE IF EXISTS "notification" CASCADE;
DROP TABLE IF EXISTS "user" CASCADE;


DROP TYPE IF EXISTS user_state;
DROP TYPE IF EXISTS report_state;

DROP INDEX IF EXISTS post_category ; 
DROP INDEX IF EXISTS post_user_id;  
DROP INDEX IF EXISTS post_vote_value ;
DROP INDEX IF EXISTS comment_info;
DROP INDEX IF EXISTS get_notification;
DROP INDEX IF EXISTS get_unanswered_reports;
DROP INDEX IF EXISTS post_search_index;
DROP INDEX IF EXISTS user_search_index;


DROP FUNCTION IF EXISTS comment_on_post();
DROP FUNCTION IF EXISTS vote_on_post();
DROP FUNCTION IF EXISTS follow_user();

DROP TRIGGER IF EXISTS comment_on_post on comment;
DROP TRIGGER IF EXISTS vote_on_post on post;
DROP TRIGGER IF EXISTS follow_user on follow;


DROP EXTENSION IF EXISTS pgcrypto;

CREATE TYPE user_state AS ENUM ('Banned', 'Suspended', 'Active');
CREATE TYPE report_state AS ENUM ('Accepted', 'Deleted', 'SuspendedUser', 'BanedUser', 'NotAnswered');

CREATE TABLE "user"(
    id SERIAL PRIMARY KEY,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    name TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    photo TEXT,
    state user_state NOT NULL, 
    is_admin BOOLEAN NOT NULL
);

CREATE TABLE category(
  id SERIAL PRIMARY KEY,
  name text UNIQUE NOT NULL 
);

CREATE TABLE follow_category(
    user_id INTEGER NOT NULL REFERENCES "user"(id),
    category_id INTEGER NOT NULL REFERENCES category(id),
    PRIMARY KEY (user_id, category_id)
);

CREATE TABLE source(
  id SERIAL PRIMARY KEY,
  name text NOT NULL UNIQUE
);

CREATE TABLE post(
    id SERIAL PRIMARY KEY,
    "datetime" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    user_id INTEGER REFERENCES "user"(id) NOT NULL,
    title TEXT NOT NULL,
    header TEXT NOT NULL,
    body TEXT NOT NULL,
    category INTEGER REFERENCES category(id) NOT NULL,
    upvotes int NOT NULL DEFAULT 0,
    downvotes int NOT NULL DEFAULT 0
);

CREATE TABLE saved_post(
    user_id INTEGER REFERENCES "user" (id),
    post_id INTEGER REFERENCES post (id),
    PRIMARY KEY (user_id, post_id)
);

CREATE TABLE post_reference(
    post_id INTEGER REFERENCES post(id),
    reference_id INTEGER REFERENCES source(id),
    PRIMARY KEY(post_id, source_id)
);


CREATE TABLE post_vote (
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES "user" (id),
    post_id INTEGER REFERENCES post (id),
    UNIQUE(user_id,post_id),
    is_up BOOLEAN NOT NULL
);
CREATE TABLE comment (
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES "user" (id),
    post_id INTEGER REFERENCES post (id) ON DELETE CASCADE,
    body text,
    "datetime" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    comment_id INTEGER REFERENCES comment(id) ON DELETE CASCADE
);

CREATE TABLE report (
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES "user" (id),
    date TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    state report_state NOT NULL,
    comment_id INTEGER REFERENCES comment(id) ON DELETE CASCADE,
    post_id INTEGER REFERENCES post(id) ON DELETE CASCADE,
    admin_id INTEGER REFERENCES "user"(id) ON DELETE CASCADE,
    UNIQUE(user_id,comment_id),
    UNIQUE(user_id,post_id)
);

CREATE TABLE follow(
    follower INTEGER NOT NULL REFERENCES "user"(id),
    followed INTEGER NOT NULL REFERENCES "user"(id),
    PRIMARY KEY (follower, followed)
);


CREATE TABLE "notification"(
  id SERIAL PRIMARY KEY,
  "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
  is_read BOOLEAN,
  receiver INTEGER REFERENCES "user"(id),
  vote_id INTEGER REFERENCES post_vote(id), 
  comment_id INTEGER REFERENCES comment(id),
  follower_id INTEGER REFERENCES "user"(id)
);


CREATE INDEX post_category ON post USING hash (category); 

CREATE INDEX post_user_id ON post USING hash (user_id);  

CREATE INDEX post_vote_value ON post_vote USING hash (is_up);

CREATE INDEX comment_info ON comment USING btree (post_id, user_id);

CREATE INDEX get_notification ON "notification" USING hash (receiver);

CREATE INDEX get_unanswered_reports ON report USING btree (state, user_id);


CREATE INDEX post_search_index ON post
USING GIST ((setweight(to_tsvector('english', title),'A') || 
       setweight(to_tsvector('english', header), 'B')|| 
       setweight(to_tsvector('english', body), 'C')));


CREATE INDEX user_search_index ON "user"
USING GIST ((setweight(to_tsvector('english', username),'A') || 
       setweight(to_tsvector('english', name), 'B')));


CREATE FUNCTION vote_on_post() RETURNS TRIGGER AS
$BODY$
BEGIN

	IF TG_OP = 'INSERT'
	THEN 
		IF EXISTS ( SELECT *
					FROM post
					WHERE NEW.post_id = post.id AND NEW.user_id = post.user_id )
		THEN
			RAISE EXCEPTION 'A member_user cannot vote on their own posts.';
		END IF;
        
	ELSIF TG_OP = 'UPDATE'
	THEN 
	IF OLD.is_up
		THEN
			UPDATE post
			SET upvotes = upvotes - 1
			WHERE id = OLD.post_id;

	ELSIF NOT OLD.is_up
		THEN
			UPDATE post
			SET downvotes = downvotes - 1
			WHERE id = OLD.post_id;
		END IF;
	END IF;
	
	IF NEW.is_up
		THEN
			UPDATE post
			SET upvotes = upvotes + 1
			WHERE id = NEW.post_id;
	ELSIF NOT NEW.is_up
		THEN
			UPDATE post
			SET downvotes = downvotes + 1
			WHERE id = NEW.post_id;
    END IF;

	/*Create notification part*/

	
	INSERT INTO notification (is_read, receiver,  vote_id, comment_id, follower_id) VALUES (FALSE, NEW.user_id, NEW.id, null, null);

    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;
 
CREATE TRIGGER vote_on_post
    AFTER INSERT OR UPDATE ON post_vote
    FOR EACH ROW
    EXECUTE PROCEDURE vote_on_post();


CREATE FUNCTION comment_on_post() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (
			SELECT *
			FROM post
			WHERE NEW.post_id= id AND NEW."datetime" < "datetime" )
		THEN
			RAISE EXCEPTION 'The comment''s time_stamp must be after the post''s time_stamp. %', New.post_id ;
	END IF;



	INSERT INTO notification (is_read, receiver,  vote_id, comment_id, follower_id) VALUES (FALSE, NEW.user_id , null, NEW.id, NEW.id);
	
	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;



/*TRIGGER 3*/
CREATE FUNCTION follow_user() RETURNS TRIGGER AS
$BODY$
BEGIN
	INSERT INTO notification (is_read, receiver,  vote_id, comment_id, follower_id) VALUES (false, NEW.followed, NULL, NULL, NEW.follower);
	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;
 
CREATE TRIGGER follow_user
    AFTER INSERT ON follow
    FOR EACH ROW
    EXECUTE PROCEDURE follow_user();


 
CREATE TRIGGER comment_on_post
    AFTER INSERT ON comment
    FOR EACH ROW
    EXECUTE PROCEDURE comment_on_post();



DROP EXTENSION IF EXISTS pgcrypto;
CREATE EXTENSION pgcrypto;

INSERT INTO "user" (username,password,name,email,state,is_admin) VALUES 
('claramoreirag',crypt('LIA7AJZ0YL', gen_salt('bf')),'Clara Moreira','clara.moreira@gmail.com','Active',TRUE),
('leonormgomes',crypt('YPJ17AJZ0YL', gen_salt('bf')),'Leonor Gomes','leonor.gomes@gmail.com','Active',TRUE),
('marianaramos',crypt('YPJ17AJZ0YL', gen_salt('bf')),'Mariana Ramos','mariana.ramos@gmail.com','Active',TRUE),
('flaviacarvalhido',crypt('YPJ17AJZ0YL', gen_salt('bf')),'Flávia Carvalhido','flavia.carvalhido@gmail.com','Active',TRUE),
('joaorosario',crypt('YPJ17AJZ0YL', gen_salt('bf')),'João Rosário','joao.rosario@gmail.com','Active',FALSE),
('bernardoramalho',crypt('YPJ17AJZ0YL', gen_salt('bf')),'Bernardo Ramalho','bernardo.ramalho@gmail.com','Active',FALSE),
('marcioduarte',crypt('YPJ17AJZ0YL', gen_salt('bf')),'Márcio Duarte','marcio.duarte@gmail.com','Active',FALSE),
('joaoluiscarvalhal',crypt('YPJ17AJZ0YL', gen_salt('bf')),'João Carvalhal','joao.carvalhal@gmail.com','Active',FALSE),
('sofiaferreiraleite',crypt('hello', gen_salt('bf')),'Sofia Ferreira Leite','sofia.fl@gmail.com','Active',FALSE),
('euricosantos',crypt('12345', gen_salt('bf')),'Afonso Eurico Santos','afonso.eurico.santos@gmail.com','Active',FALSE),
('jorgetavares',crypt('YPJ17AJZ0YL', gen_salt('bf')),'Jorge Tavares','jorge.tavares@gmail.com','Active',FALSE),
('inesribeiro',crypt('YPJ17AJZ0YL', gen_salt('bf')),'Inês Ribeiro','ines.ribeiro@gmail.com','Active',FALSE);

INSERT INTO "category" (name) VALUES ('Clean cities'),('Climate change'), ('Renewable energy'),('Recepies');

INSERT INTO "source" (name) VALUES ('https://sustainablemobility.iclei.org/upcoming-ecologistics-report-2021/'),
('https://talkofthecities.iclei.org/reloading-multilevel-climate-action-towards-glasgow-cop26/'),
('https://talkofthecities.iclei.org/tackling-climate-change-and-covid-19-at-the-local-level-in-africa/'),
('https://iclei.org/en/media/japan-to-go-climate-neutral-with-support-of-net-zero-cities'),
('https://daringcities.org/program/tedxdaringcities-daring-to-go-climate-neutral-session-1/'),
('https://www.nytimes.com/2021/03/17/climate/nyt-climate-newsletter-sea-level.html'),
('https://www.nationalacademies.org/news/2021/03/new-report-says-u-s-should-cautiously-pursue-solar-geoengineering-research-to-better-understand-options-for-responding-to-climate-change-risks');

INSERT INTO "post" (user_id,title,header,body,category) VALUES 
(4,'Creating liveable cities through low-carbon freight','Freight transport and emissions are increasing rapidly and, until now, cities were not equipped to handle the associated challenges. Only about 21 percent of the Nationally Determined Contributions (NDCs) highlighting transport refers to freight transport. Nonetheless, general understanding and awareness on sustainable freight have grown exponentially in recent years.',
'<body><p>As governments set ambitious targets to decarbonize transport, it is critical that they use data to evaluate and make science-based decisions. However, there exists a range of common urban freight data issues.
<br>Calculating emissions is the first step. Through the EcoLogistics project, nine cities have used the ICLEI EcoLogistics Self-monitoring Tool to compile and evaluate the data on the urban freight activities taking place in their jurisdictions. The data compiled forms a baseline for these cities to take informed, effective action to curb freight emissions – contributing to a sustainable low-carbon future.
<br>These cities are some of the first to compile this body of data on urban freight activities. Here is what they found and what peer cities can learn from their experience:
<br>Air quality and emission reduction: Bottom-line incentives to tackle the urban freight sector
<br>Most cities are confronted with problems of air- and noise-pollution caused by road traffic. Heavy-duty trucks consume 7.3 percent of global energy-related emissions and will almost double according to the International Energy Agency. Reducing emissions from these vehicles presents an opportunity to slow the rate of near-term climate change and to achieve substantial public health benefits.
<br>Studies of the Metropolitan Region of the Aburrá Valley (AMVA), which is composed of 10 municipalities and is the second most populous metropolitan area in Colombia, show that motorized vehicles were responsible for 81 percent of PM2.5  emissions in 2015; trucks were responsible for 64 percent of PM2.5, despite comprising only 4 percent of total vehicles in the region. In response, AMVA’s Comprehensive Air Quality Management Plan set out a renewal program for freight vehicles to phase in ultra-low and zero-emission vehicles.</p></body>',1),
(5,'Betting on Multilevel Climate Action for COP26 in Glasgow','On 17-18 March 2021, the Ministry of Environment of Japan will convene the Zero Carbon City International Forum, which has been recognized as 2021’s first global dialogue to advance multilevel action under the Paris Agreement. This dialogue is convened in collaboration with the UN Climate Change Secretariat (UNFCCC), the Institute for Global Environmental Strategies (IGES), and ICLEI – Local Governments for Sustainability.','<body><p>The event comes at a critical moment in the road to COP26. The current state of the global climate agenda is relatively opaque. Despite an urgent call by the UN Secretary-General Antonio Guterres to kick off virtual negotiations, preparations for COP26 in Glasgow are still in limbo.
<br>And more dire news continues to roll in from the UN’s own reports. According to a recently-launched report by the UN Climate Change, the revised Nationally Determined Contributions (NDCs) would reduce less than 1 percent of global greenhouse gas emissions in comparison to the 45-50 percent needed by 2030. The UN Environment’s flagship report “Making Peace with Nature” focuses on the dire need to address the interconnected climate, biodiversity and pollution emergencies.
<br>However, in the face of these challenges, we are seeing increased conversations on how to implement multilevel climate action. At the heart of these conversations are national and global institutions that are engaging with and empowering local and regional governments. Through this work, they are setting a precedent for what collaborative, multilevel climate action could become.
<br>So, the Zero Carbon City International Forum in Japan is an important opportunity to refresh and elevate the vision and achievements of the Local Governments and Municipal Authorities (LGMA) Constituency to the UNFCCC towards COP26, especially the 7-pillar vision for a “Multilevel Action COP”</p></body>',2),
(5,'Tackling climate change and COVID-19 at the local level in Africa','The COVID-19 pandemic has dramatically affected the work of national, regional, and local governments. Many countries around the world have imposed lockdowns and physical distancing measures while preparing massive economic relief packages. In several places in Africa, however, hand washing alone has been a critical challenge. Shortages of water, soap, nutritious food, and hospital equipment have all added to the huge challenges that national and local governments in Africa have to deal with. So, how is it possible to continue climate action efforts in this context?','<body><p>To support African local governments navigate some of the critical issues they face and help them respond swiftly, ICLEI Africa and the Covenant of Mayors in Sub-Saharan Africa joined forces and created a collection of resources specifically tailored for African cities. With more than 200 curated entries, this resource inventory includes best practices, training, policy briefs, and articles from around the world that have been customized to support African local governments and are provided in local languages. The resources were packaged into eight main themes and complemented a series of webinar training scheduled between June and September 2020. Here are some highlights and resources from these main themes.
<br>Adaptation finance is partially there, but scalable solutions and bankable projects remain a challenge
<br>Cities in Africa are among the most vulnerable to climate risks in the world, and for them to become more climate-resilient, a significant amount of funding is required to enable climate change adaptation. However, not only does just 4 percent of global climate finance flow to the African continent, but only a fraction of that reaches the city-level, mostly for climate change mitigation projects. Additionally, city officials grapple to understand specific financial terminology and contracts, which further hinders their ability to propose financially attractive and bankable projects.
<br>Potential solutions vary from translating contracts into more comprehensible texts to financial training for public officials, but according to Mayor Mohamed Sefianiof Chefchaouen, Morocco, international city networks are the key: they can, in fact, support local governments with knowledge exchange, training with peers, and connections to initiatives that ease access to finance for cities. For instance, the Transformative Action Program (TAP) is a partnership initiative to improve the bankability of local and regional governments’ projects through specific and customized tools and services, as well as connecting them to project preparation facilities and financial institutions. Since 2015, through the support of the TAP, 26 local climate projects have been successfully financed and implemented, more than 50 have been connected to financial institutions, and 66 are now in the TAP pipeline with an estimated investment volume of €2.5 billion.</p></body>'
,2),
(4,'Japan to go climate neutral with support of net zero cities','On Monday 26 October, Prime Minister Suga pledged in his first general policy speech to reduce greenhouse-gas emissions in Japan to net zero by 2050. This new target replaces the existing commitment to reduce emissions by 80 percent by the same date and brings Japanese climate ambitions in line with the EU and other countries, cities, regions, and businesses pursuing neutrality.','<body><p>Local and regional governments in Japan have been leading the way in committing to carbon neutrality by 2050. With support from ICLEI Japan, through efforts such as multilevel dialogues, local governments have been actively engaging with national government to achieve more ambitious national climate commitments.
<br>The Governor of Nagano Prefecture, Mr. Abe Shuichi, who acts as Chair for the project team to promote Zero Carbon Society within the National Governors Association, compiled a set of Urgent Recommendations with the support of 34 other prefectures which he delivered to the Ministry of Environment, the Agency for Natural Resources and Energy, the Ministry of Economy, Trade and Industry, and the Cabinet Secretariat in August 2020. The recommendations state that the national government should take a leadership role in actively working on climate change countermeasures and declare zero carbon by 2050.
<br>The commitment to a zero carbon future was reiterated by Governor Abe during his address at ICLEIs Daring Cities “Daring To Go Climate Neutral” discussion on 14 October, where he outlined the mitigation efforts Nagano prefecture has taken after declaring climate emergency in December 2019.
<br>Minister Koizumi, the Japanese Minister for the Environment, joined live for the Daring Cities “Driving the Green Recovery and Redesign” panel discussion on 21 October, where he agreed with the importance of zero carbon cities, announcing that Japan will host the global Zero Carbon City Forum in early 2021, and expressed his ambition to create a more sustainable and resilient society which provides economic growth post COVID-19.
<br>“The Forum will provide an opportunity for local governments all over the world aiming for net zero carbon emissions to share advanced approaches and challenges, facilitating concrete actions” Koizumi said. Adding “I expect this forum to be a driving force of the UNFCCC’s Race to Zero campaign.”
<br>Though local governments will play a key role in this transition, Prime Minister Sugas announcement shows that national government is taking a leading role in delivering on international environmental commitments.
<br>ICLEI is recognized by the Japanese Ministry of Environment as a leading partner in supporting the momentum of local governments. Japans commitment to net zero must be followed by concrete measures to cut emissions, but it represents already represents a success for the local authorities across Japan that have been working to see their motivation and commitment to a net zero future be reflected in government action at the national level. ICLEI will continue to facilitate the exchange between local, regional and national government representatives.</p></body>',3),
(5,'TEDxDaringCities: Cities Going Climate Neutral','The theme of TEDxDaringCities is cities that are going climate neutral – the how, the why now, and the how do we get more cities onboard. We’ll hear from cities worldwide that are working feverishly towards this goal, and the international partners who are helping them to achieve these goals.','<body><p>TEDxDaringCities will showcase those bold, visionary urban leaders who have made the ultimate commitment toward tackling the climate emergency by setting a target of climate neutrality for their territories, and are actively leading the way toward achieving that target through climate change resilience and bold climate mitigation efforts.
<br>TEDxDaringCities is made up of three sessions throughout the day of 14 October 2020, including the voices of local governments from around the world and a special Countdown film.</p></body>',4),
(6,'What Are We Willing to Pay to Fight the Rising Sea?','A North Carolina community risks washing away, and solutions don’t come cheap. It very likely offers a glimpse of things to come.','<body><p>As the ocean rises, homeowners in Avon, a tiny town on the Outer Banks of North Carolina, are confronting a tax increase of almost 50 percent to defend the only road into town. Residents want somebody else to pay for it; local officials say they’re on their own.
<br>But the proposed fix, spending at least $11 million to add one million cubic yards of sand to the beach, is temporary. That’s because the sand will wash away again. Residents want a more lasting fix; officials say there isn’t one.
<br>Quotable: “We’re just masking a problem that never gets fixed,” a longtime resident of Avon said.
<br>Why it matters: Avon’s dilemma is a prelude for countless towns and cities along America’s coast, which are increasingly being forced to raise taxes or borrow money to protect their homes, roads and schools. As seas keep rising, so will the cost of holding back the water.</br></body>',2),
(7,'Solar Geoengineering Should be Investigated, Scientists Say','A controversial policy to address climate change by artificially cooling the planet deserves more research, according to a panel of leading U.S. scientists','<body><pr>But only if it is carefully governed.
<br>Thats the major conclusion from a report on solar geoengineering released yesterday by the National Academies of Sciences, Engineering and Medicine. The report recommends that the federal government invest up to $200 million over the next five years to develop a national research program.<br>
Solar geoengineering refers to a kind of climate engineering aimed at cooling the planet by reflecting sunlight away from the Earth and back out to space. So far, its a purely hypothetical idea — but scientists have proposed a number of ways it could be done.
<br>The most common proposal suggests spraying reflective aerosols into the atmosphere, where they would beam sunlight away from the Earth. Other proposals involve making clouds brighter by injecting them with particles, or to help trap less heat beneath them.
<br>They are contentious ideas. Experts have many concerns about the possibility of unintended consequences, such as unwanted effects on rainfall or other global weather patterns.
<br>Furthermore, solar geoengineering does not address the root cause of climate change — greenhouse gas emissions. It simply masks their warming effect on the planet. There are consequences of rising carbon dioxide levels, such as ocean acidification, that geoengineering can not address.
<br>There is also the question of whether humans, and Earth, could become dependent on geoengineering. These practices, if begun, could become virtually impossible to stop if emissions continue to rise. Doing so could cause temperatures to skyrocket, according to some researchers.</pr></body>',3);

INSERT INTO "post_vote" (user_id,post_id,is_up) VALUES (6,3,TRUE),(6,2,TRUE),(5,6,FALSE),(8,1,TRUE),(8,4,TRUE),(8,2,FALSE),(9,3,FALSE),(9,6,FALSE),(10,1,TRUE),(10,2,TRUE),(10,6,TRUE);

INSERT INTO "post_source" (post_id, source_id) VALUES (1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7);

INSERT INTO "saved_post" (user_id,post_id) VALUES (5,3),(6,2),(5,6),(8,1),(8,3),(8,2),(9,1),(9,5),(9,6),(10,1),(10,2),(10,5);

INSERT INTO "follow" (follower,followed) VALUES (5,6),(7,5),(6,7),(7,8),(8,7),(8,5),(5,9),(9,6),(9,7);

INSERT INTO "follow_category" (user_id,category_id) VALUES (5,1),(5,2),(6,3),(6,1),(7,3),(9,2),(10,2),(10,1),(11,2);

INSERT INTO "comment" (user_id,post_id,body) VALUES (5,3,'Very good post'), (9,3,'It is a great thing that climate change is being adressed'),(7,4,'Very good post'), (8,6,'It is a great thing that climate change is being adressed');

INSERT INTO "comment" (user_id,post_id,body,comment_id) VALUES (7,3,'Indeed',1), (9,3,'It really is',2);



INSERT INTO report(user_id,state,comment_id) VALUES (5,'NotAnswered',1),(6,'NotAnswered',1), (7,'NotAnswered',2);
INSERT INTO report(user_id,state,post_id) VALUES (8,'NotAnswered',1),(6,'NotAnswered',1), (7,'NotAnswered',2);


INSERT INTO "notification"(is_read,receiver,vote_id) VALUES (FALSE,5,2), (TRUE,5,3),(FALSE,4,1), (FALSE,4,4);
INSERT INTO "notification"(is_read,receiver,comment_id) VALUES (TRUE,5,2), (FALSE,5,3),(FALSE,4,1), (FALSE,4,4);
INSERT INTO "notification"(is_read,receiver,follower_id) VALUES (FALSE,5,6), (FALSE,5,7),(FALSE,4,5), (FALSE,4,8),(TRUE,4,6), (TRUE,6,7);

