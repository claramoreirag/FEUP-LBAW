# ER: Requirements specification

## Product vision
Our vision is to provide an accurate platform where sustainability is empowered through the sharing and discussion of related matters, to bring awareness to everyone.

## A1: Collaborative News - GreeNews

#### Goals, business context, and environment:
GreeNews intends to promote an online information system that can compile news from several collaborators about sustainability and the environment. This platform will be available to everyone interested in the environmental cause. It will stand out from similar platforms since our priority is to ensure the safety and accuracy of posted news. 

#### Motivation:
Now more than ever, there are pressing matters regarding the environment that make it to the newspaper’s headlines every single day. We aim to provide a platform that can support updated news, have a solid base of verified information to educate people on these matters, and call for action. 

#### Main features:
GreeNews will have as the main feature a system where users can post and edit news regarding different topics inside the theme of sustainability. The users will also be able to comment on them, search by tags and upvote/downvote them. Additionally, users can sign up to this platform or sign in if they already have an account. To keep this platform organized, we will use the votes on each post to order them by relevance and create a list with the most pertinent news of the week. To promote a post, a user can share them on their social media or via email.
Users will be able to use advanced search criteria to order/filter the posts in their feed, such as top rated of the week, most recent posts, posts related to a certain topic, etc. When a user follows another account or tag, their personalized feed will feature posts from these accounts/tags. 
All the news posted can be reported by users if their sources are incorrect/untrusted or if they violate the platform's rules. They will later be checked by a moderator which will be able to delete them if need be. Ultimately, the moderator can also ban/suspend accounts.
The interface will be simple, objective, reliable as well as cross-platform, making the platform able to achieve its intended purpose. 

#### User profiles:
An authenticated user will be able to post news, comment on posts, search news by tags, and upvote/downvote posts or comments.
Google Authentication API can be used to log in/sign up in the platform.
A visitor or anonymous user is only able to see the feed and share news.
A writer is an authenticated user who writes posts or comments and has the ability to edit and delete them later. 
There will be an administrator user performing moderator tasks, analysing reported posts/comments to maintain a trustworthy platform with verified information, free of judgment. Additionally, they will manage all profiles on the platform, deleting and blocking accounts if necessary.

## A2: Actors and User stories

This artifact aims to describe the different actors that will interact with the GreeNews platform, as well as their user stories. This will help define the requirements and features of the project.

### 1. Actors

![actors](uploads/1623b9bb224ed723bca1abc8554fb923/actors.png)

Figure 1: Actors



| Identifier |Description | Examples |
| -------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------ | --------------------------- |
| User                 | A user can consult news, search for content and consult user profiles.  | n/a    |
| Visitor              | Can see the feed and search/read the news. Can also create an account or authenticate in the system to become an Authenticated User.     | n/a  |
| Authenticated User   | An authenticated user can have its own profile, can follow other users, have followers and have its own feed. Additionally, this user can upvote/downvote other user's posts, as well as report them.  | janedoe  |
| Writer               | A writer is an authenticated user that writes posts and comments.| janedoe  |
| Admin                | Responsible for managing the users by deleting and blocking accounts if necessary. It also serves the purpose of a moderator by making sure the news are reliable, trustworthy and the platform doesn't have hateful content.| admin  |
| Google Authentication API    | External Authentication API that allows to register and sign in the system with a Google Account. | Google Authentication API |

Table 1: Actors' description

<br>
<br>

### 2. User Stories

The GreeNews system considers the following user stories:

**User**

| Identifier | Name | Priority | Description |
|------------|-----------------------------------------------------|----------|--------------------------------------------------------------------------------------------------------------------------------------|
| US01 | Search News  | high | As a User, I can search for news on certain topics, so that I can find posts according to my interests. |
| US02 | See comments, upvotes, downvotes | medium | As a User, I want to see a post in detail, so that I can see its comments, number of upvotes and downvotes. |
| US03 | Consult user profiles | high | As a User, I can consult user profiles, so that I see their written posts.  |
| US04 | Search user profiles | high | As a User, I can search for user profiles, so that I can find users.  |
| US05 | Feed | high | As a User, I want to see the feed with the most relevant news (the most upvoted), so that I can read the most relevant posts. |
| US06 | Share news post | low | As a User, I want to be able to share posts via email and social media, so that I can inform other people. |

Table 2: User's user stories



**Visitor**

| Identifier | Name | Priority | Description |
| ---------- | -------------------------- | -------- | --------------------------------------------------------------------------------------------------------------------------------------------------- |
| US07 | Sign In | high | As a visitor, I want to sign in, so that I can access my user profile. |
| US08 | Sign Up | high | As a visitor, I want to sign up, so that I can have a user profile and follow other users. |
| US09 | API Sign In | low | As a visitor, I want to authenticate on the website with my Google account so that I can access my user profile. |
| US10 | API Sign Up | low | As a visitor, I want to create a new account using my Google account so that I can have a user profile and follow other users. |

Table 3: Visitor's user stories


**Authenticated User**


| Identifier | Name | Priority | Description |
|------------|------|----------|-------------------------------------------------------------------------------------------------------------------------------------------------------------|
| US11       | Log Out                | high     | As an Authenticated User, I want to log out of my account, in case I want to switch account.                                                                |
| US12       | Edit Profile                           | high     | As an Authenticated User, I want to edit my profile, so that I can update my information (name, username, profile picture, password).                                                                                                               |
| US13       | See Own Profile                           | high     | As an Authenticated User, I want to see my own profile, so that I can see my information (name, username, profile picture, number of followers, number of people I follow, number of total upvotes, number of posts made and own posts).                                                                                                               |
| US14       | Delete Account                  | high     | As an Authenticated User, I want to delete my account, choosing if my content is deleted as well or not. So that I won't be able to use my profile anymore but my content can still be seen if I choose to.                                                                  |
| US15       | Follow Users                          | medium     | As an Authenticated User, I want to follow other users, so that their posts appear in my feed.                                                |
| US16       | Follow Tags                          | medium     | As an Authenticated User, I want to follow tags, so that related posts appear in my feed.  | 
| US17       | Vote on Posts                         | medium    | As an Authenticated User, I want to upvote/ downvote a post, so that I can express my content.                                         |
| US18       | Personalized Feed                  |medium     | As an Authenticated User, I want to see a feed with the most recent posts of the people I follow, so that I can keep updated.                               |
| US19       | Report Posts              | low     | As an Authenticated User, I want to report posts that are hateful/against the rules, so that I help keep the platform safe and clean while also protecting myself.    
| US20       | Report Comments              | low     | As an Authenticated User, I want to report comments that are hateful/against the rules, so that I help keep the platform safe and clean while also protecting myself.                                                             |
| US21       | Save Posts                             | low    | As an Authenticated User, I want to save posts so that I can read them later. |
| US22       | Notifications                             | low    | As an Authenticated User, I want to receive notifications whenever someone follows me or upvotes/downvotes my posts so that I can keep track of my activities. |

Table 4: Authenticated user's user stories


**Writer**

| Identifier | Name                               | Priority | Description                                                                                                     |
|------------|------------------------------------|----------|-----------------------------------------------------------------------------------------------------------------|
| US23       | Create Post | high     | As a Writer, I want to create new posts with valid sources, so that I can contribute to the website.          |
| US24       | Edit Post                        | high     | As a Writer, I want to edit my posts, so that I can make it more accurate or better. |
| US25       | Delete Post                       | high     | As a Writer, I want to delete my own posts, in case the post becomes irrelevant. |
| US26       | Write Comments                              | high     | As a Writer,  I want to write comments, so that I can express my opinion regarding a post.                                                       |
| US27       | See Own Posts                     | high     | As a Writer, I want to see all my written posts, so that I can review my older posts. |
| US28      | Reply to Comments                         | medium     | As Writer, I want to reply to comments, so that I can express my opinion regarding a comment. |
| US29      | Tag Post                      | medium     | As a Writer, I can tag my post, so that my post is related to a theme. |

                        

Table 5: Writer's user stories


**Admin**

| Identifier | Name  | Priority | Description  |
|------------|-----------------------|----------|-----------------------------------------------------------------------------------------------------------------------|
| US30       | Reports Dashboard      | high     | As an Admin, I want to be able have a dashboard with all reported posts and comments, so that I can manage them.  |
| US31       | Delete posts  | high     | As an Admin, I want to be able to delete posts that are against the platform rules, so that the platform is safe and free of unwanted posts.                               |
| US32       | Delete comments  | high     | As an Admin, I can delete comments, so that hateful comments can be deleted. |
| US33       | Delete accounts  | high     | As an Admin, I want to be able to delete accounts, so that I can take access from invalid users. |
| US34       | Block Accounts      | medium     | As an Admin, I want to be able to block accounts, so that I can keep users from accessing their account.  |


Table 6: Admin's user stories




## 3. Annex: Supplementary requirements


**Business Rules**

| Identifier | Name          | Description                                                                            |
|------------|---------------|----------------------------------------------------------------------------------------|
| BR01       | Unique User   | An authenticated user must have a unique email and unique username.                   |
| BR02       | Post Author   | All news posts must have an author.                                                    |
| BR03       | Post Source   | All news posts must have references to their original sources.                         |
| BR04       | Denouncing Inadequate Content  | After three denounces on the same post or comment, an administrator will review it.          |
| BR05       | Block Account  | If a user posts content deemed inadequate by an admin, the account will be blocked and the content will be deleted. Blocking an account means the user can't access it for 15 days. |
| BR06       | Delete Inadequate Account | If a previously blocked user continues to post inadequate content, his account will be deleted. |
| BR07       | Auto Like | An Authenticated user can't like their own post.   |
| BR08       | Delete Account | When an Authenticated user deletes their account they can choose if their posts and comments should be deleted as well.   |

**Technical Restrictions**

| Identifier | Name            | Description                                                                                                                                                        |
| ---------- | --------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| TR01       | Availability    | The system must be available 99 percent of the time in each 24-hour period   |
| TR02       | Accessibility   | The system must ensure that everyone can access the pages, regardless of whether they have any handicap or not, or the Web browser they use. |
| TR03       | Usability       | The system should be simple and easy to use. |
| TR04       | Performance     | The system should have response times shorter than 2s to ensure the user's attention      |
| TR05       | Web application | The system should be implemented as a Web application with dynamic pages (HTML5, JavaScript, CSS3 and PHP)   |
| TR06       | Portability     | The server-side system should work across multiple platforms (Linux, Mac OS, etc.)   |
| TR07       | Database        | The PostgreSQL 9.4 database management system must be used    |
| TR08       | Security        | The system shall protect information from unauthorised access through the use of an authentication and verification system  |
| TR09       | Robustness      | The system must be prepared to handle and continue operating when runtime errors occur  |
| TR10       | Scalability     | The system must be prepared to deal with the growth in the number of users and their actions   |
| TR11       | Ethics          | The system must respect the ethical principles in software development (for example, the password must be stored encrypted to ensure that only the owner knows it) |
| TR12       | Responsive  | The system should be responsive no matter the size of the screen. |

The top 3 technical restrictions in our project are *TODO*
**Restrictions**

| Identifier | Name     | Description                                                       |
| ---------- | -------- | ----------------------------------------------------------------- |
| C01        | Deadline | The system should be done by 31/05/2021. |
| C02        | ER Submission | The requirements specification should be done by 15/03/2021. |
| C03        | EBD Submission | The database specification should be done by 12/04/2021. |
| C04        | EAP Submission | The application architecture and prototype should be done by 26/04/2021. |
| C05        | Availability | During the course of this project there will be deadlines for other projects which will make us less available to work on those times. |

***


## A3. User Interface Prototype

The goals of this user interface prototype are to help identify and describe the user requirements while raising new ones. Additionally, it previews and tests the user interface of the product to be developed in further artifacts and enables fast and numerous interactions on the design of the user interface.

This artifact contains three elements as the overview of the interface elements and features common to all pages, the overview of the information architecture from the viewpoint of the users, using a sitemap, and, finally, identification and description of the main interactions with the system, organized as a sequence of screens.

**1. Interface and common features**

GreeNews is a website based on HTML, PHP, and CSS. We implemented the user interface with the Bootstrap framework.

![commonfeatures](uploads/9019b9300ab4294c83612df6e18f27a6/commonfeatures.png)

- 1 - Logo
- 2 - Navbar
- 3 - Content
- 4 - Footer

**2. Sitemap**

A sitemap is a visual representation of the relationship between the different pages of a website that shows how all the information fits together.

The sitemap gives the project team an idea of how the website is going to be built by helping to clarify the information hierarchy. 

![sitemaplbaw](uploads/69b974217864d8e95a8bd9e7cb475973/sitemaplbaw.png)

**3. WireFlows**

In this section, we present the Wireflows designed to effectively document the holistic user interaction. We show complete views of different pages using a series of wireframes connected by arrows representing the path taken and communicating the functionality.


**i)** *Wireflow centered on the visitor's options*

Starting at the GreeNews homepage you can see all the trending news ordered by the date. 
There are available several searching options: select tags, use the search bar to search for users or news, and reorder the news by the most upvoted news of the week. To know more about the website you can use the "About Us" button that will take you to a presentation page of the website. In the header, you can press the "Login" button that will take you to the Login Page or the "Sign Up" button in case you don't have an account.


![Wireflow centered on the visitor's options](uploads/055c9d1280a4eb712194a78f2d7107b2/wireflow1.PNG)

Figure 3.1 - Wireflow centered on the visitor's options


**ii)** *Wireflow centered on the authenticated user's options*

Once you are authenticated you are back on the homepage, this time with one more searching option of seeing your personal feed. To write news you can press your username on the header that will take you to your Profile Page. 
Here you can see your own posts, the posts you upvoted and saved. You can also see your followers, the people you are following, and manage them. Pressing the "Edit Profile" button you will see a pop-up to do so. And to add your news you can press the "+" button on the corner. Once you press the "Publish" button on the New Post Page you are redirected to the homepage. Your news will appear on the top and you can press on "Read More" button to go to the Full Post Page. Here you can see all the comments among other interactions. Pressing the "Back" button you are back on the homepage. You can also reach the homepage by clicking on the logo of the navbar. Additionally, when scrolling through the posts you can press the Profile Picture of the writers to visit their profile page where you can follow them. Finally, you can start following a Tag by hovering the mouse on top of it on each post.


![Wireflow centered on the authenticated user's options](uploads/1bbc812e25ae656eb8e1c9bcbeff7759/wireflow2.PNG)

Figure 3.2 - Wireflow centered on the authenticated user's options

**iii)** *Wireflow centered on the administrator's options*

The Management Wireflow displays the interactions available to Administrators wich have Moderator roles. Here they can manage reported Posts and Comments as well as manage all the user's by pressing the "User Management" button on the header. By pressing on a row of the reported content table the administrator has access to a Full Post Page where he can take different actions. 


![Wireflow centered on the administrator's options](uploads/c126090ed85e20045cb394eb7868a232/wireflow3.PNG)

Figure 3.3 - Wireflow centered on the administrator's options

To see the full wireframe project click [here](https://projects.invisionapp.com/freehand/document/CxivpE1IR).

**4. Interfaces**

The following interfaces depict the main content of the web pages, which help the project team previewing the features and behavior of the final product's different screens, both in their desktop and mobile versions.

- UI01: Homepage
- UI02: AboutUs  
- UI03: Own Profile 
- UI04: Other User Profile
- UI05: Full Post Page
- UI06: SignUp
- UI07: LogIn
- UI08: AuthUserFeed
- UI09: New Post Page
- UI10: Edit Post Page
- UI11: Admin Dashboard
- UI12: User Manager
- UI13: Full Post Page Admin

 **UI01: [Homepage](http://lbaw2154-piu.lbaw-prod.fe.up.pt/pages/homepage.php)**
![homepage1](uploads/fed93e511d7f2a4b8994d03146df996b/homepage1.png)
![homepage2_new](uploads/aba41d14411ca830d8db9531974010bc/homepage2_new.png)

![homepage_resp_1](uploads/99afdb41542e97e61679c85d53901e4e/homepage_resp_1.png)

![homepage_resp_2](uploads/1f033b3c96322cd4855795d74ef7a418/homepage_resp_2.png)

![homepage_resp_3](uploads/fe11a8b078a5ae6d7b0c1326c368d8a6/homepage_resp_3.png)

![homepage_resp_4](uploads/5290da78fc7a230ffa4aa45ef6ab2531/homepage_resp_4.png)


**UI02: [AboutUs](http://lbaw2154-piu.lbaw-prod.fe.up.pt/pages/aboutUs.php)**
![aboutUs1](uploads/fc41ebcc8538b0e0998f1d693cd4ab09/aboutUs1.png)
![aboutUs2](uploads/6693306289d69d840891bf3c2413a37c/aboutUs2.png)
![aboutUs3](uploads/dfe9bcce886bca2d08fdbee019ddd4e3/aboutUs3.png)

![aboutUs_resp_1](uploads/58133b26e15676ac7c16cebbd2143f92/aboutUs_resp_1.png)

![aboutUs_resp_2](uploads/b199a3b4d0e6c3cbeeed8e716304f339/aboutUs_resp_2.png)

![aboutUs_resp_3](uploads/22ce8ff6b3140cc98cde2a0f2505b420/aboutUs_resp_3.png)

![aboutUs_resp_4](uploads/7df774239686a05d5a734397f6482abb/aboutUs_resp_4.png)

![aboutUs_resp_5](uploads/802a44b5696a6b1ce1ccecd9ecf55c9d/aboutUs_resp_5.png)

![aboutUs_resp_6](uploads/538d6db4abfb05aabd5d8251fd37b53f/aboutUs_resp_6.png)


**UI03: [Own Profile](http://lbaw2154-piu.lbaw-prod.fe.up.pt/pages/myProfilePage.php)**
![myProfilePage1](uploads/520a9e403291da0d3b16a3bf5d2f0f58/myProfilePage1.png)
![myProfilePage2](uploads/ee5e4937107c97612b307e8455c5cffb/myProfilePage2.png)
![myProfilePage3](uploads/de11c399f4932888b360cc576749e163/myProfilePage3.png)

![myProfilePage_resp_1](uploads/db70c91c58faeea065c2d3d5c89a62f3/myProfilePage_resp_1.png)

![myProfilePage_resp_2](uploads/e0b26f97c4de6e4e172279b29b7d1c3c/myProfilePage_resp_2.png)

![myProfilePage_resp_3](uploads/f1bebc8bc1fcdfa01a9232db06407eee/myProfilePage_resp_3.png)


**UI04: [Other User Profile](http://lbaw2154-piu.lbaw-prod.fe.up.pt/pages/otherProfile.php)**
![otherProfile1](uploads/1bdefbb79d925c4d8680915fe0fbc85c/otherProfile1.png)
![otherProfile2](uploads/c8c84acf64cd2c4db6af9b2c0c083871/otherProfile2.png)

![otherProfile_resp_1](uploads/4de0a7be1ed284698ca7f23a9ad98574/otherProfile_resp_1.png)

![otherProfile_resp_2](uploads/d0516f891889eb3b7cda993aeb2f95d1/otherProfile_resp_2.png)

![otherProfile_resp_3](uploads/a132fa73d51545c9397d6341bb004908/otherProfile_resp_3.png)


**UI05: [Full Post Page](http://lbaw2154-piu.lbaw-prod.fe.up.pt/pages/fullPostPage.php)**
![fullPostPage1](uploads/7a11234d3ed1dd34e81478de650ff28d/fullPostPage1.png)
![fullPostPage2](uploads/cf39ac9a5962cc8e4db816625abb68ed/fullPostPage2.png)

![fullPostPage_resp_1](uploads/e5ad407598db87c2c66e18e7b13deb94/fullPostPage_resp_1.png)

![fullPagePost_resp_2](uploads/2cd5f07ec747e3f8e80fe85959a1866d/fullPagePost_resp_2.png)

![fullPostPage_resp_3](uploads/c3fd1ddbedee178c63b091a4af79a5ff/fullPostPage_resp_3.png)

![fullPostPage_resp_4](uploads/9911ae89dbed0fb8462a51b7747b771d/fullPostPage_resp_4.png)

![fullPostPage_resp_5](uploads/f1fcafc83a6ba190dec3b76de34e133a/fullPostPage_resp_5.png)


**UI06: [SignUp](http://lbaw2154-piu.lbaw-prod.fe.up.pt/pages/signup.php)**
![signup1](uploads/a3fb22a386e5b2e19ec24ef55488f100/signup1.png)
![signup](uploads/94ee8a2f5faec6c1b9f1cde9dca8b29d/signup.png)

**UI07: [LogIn](http://lbaw2154-piu.lbaw-prod.fe.up.pt/pages/login.php)**
![login](uploads/0a9eb2c8774c0eef1d0677384be22c61/login.png)
![login_resp](uploads/ef06be1395a1ed118e3ee19ff2d58b31/login_resp.png)

**UI08: [AuthUserFeed](http://lbaw2154-piu.lbaw-prod.fe.up.pt/pages/authUserFeed.php)**
![authUserFeed1](uploads/35101a4026ac0bdbafd49649e22abdc7/authUserFeed1.png)
![authUserFeed2](uploads/16fd9511ab40f62f8b3ab2c423a42b3a/authUserFeed2.png)

![authUserFeed_resp_1](uploads/e2099084bfae16764390501767edc322/authUserFeed_resp_1.png)

![authUserFeed_resp_2](uploads/128340f1dcabacbd850f1ea36ba77e61/authUserFeed_resp_2.png)

![authUserFeed_resp_3](uploads/3322f20098be5f59fc9de193a0b43970/authUserFeed_resp_3.png)

![authUserFeed_resp_4](uploads/42f58d5cba19ce85db2b0af7e6228e9a/authUserFeed_resp_4.png)

**UI09: [New Post Page](http://lbaw2154-piu.lbaw-prod.fe.up.pt/pages/newPostPage.php)**
![newPost](uploads/464b25e6705bb1ca0df4870a432b6b9d/newPost.png)
![newPost1](uploads/437c0576b542a0eafb02338e90e23b1b/newPost1.png)

![newPost2](uploads/e50a43da82853afb14e1b72236094ea4/newPost2.png)

**UI10: [Edit Post Page](http://lbaw2154-piu.lbaw-prod.fe.up.pt/pages/editPostPage.php)**
![editPost](uploads/cb09ab3cbdedcd03276ed3ea1bb42455/editPost.png)
![editPost1](uploads/b60baf9e2e7ab836af92da0cd7247f99/editPost1.png)

![editPost2](uploads/b0633d84fdcf64063c43b82d2cd2f568/editPost2.png)


**UI11: [Admin Dashboard](http://lbaw2154-piu.lbaw-prod.fe.up.pt/pages/adminDashboard.php)**
![adminDashboard](uploads/33092f5314520f6336ae5dced22f7395/adminDashboard.png)

![adminDashboard_resp_1](uploads/2fcc422aac1106e20298343c63daf2af/adminDashboard_resp_1.png)

![adminDashboard_resp_2](uploads/ea8e6a577648829b4477dfeb241687c7/adminDashboard_resp_2.png)

**UI12: [User Manager](http://lbaw2154-piu.lbaw-prod.fe.up.pt/pages/userManager.php)**
![userManager1](uploads/ad1c3681e0e06d8fdb27d2edc13db78d/userManager1.png)

![userManager_resp_1](uploads/68febb589d27027ce5b515da74e9acf8/userManager_resp_1.png)

![userManager_Resp_2](uploads/276ba7e193a0dc6f1ef0b75ca1de9245/userManager_Resp_2.png)

**UI13: [Full Post Page Admin](http://lbaw2154-piu.lbaw-prod.fe.up.pt/pages/fullPostPageAdmin.php)**
![fullPostPageAdmin1](uploads/9166bfe4e936e742456de39663e3c628/fullPostPageAdmin1.png)
![fullPostPageAdmin2](uploads/535d436b4e8db8c6825ac14ca5346398/fullPostPageAdmin2.png)
![fullPostPageAdmin3](uploads/19137b156eecd5e66a796c7c7ce257ef/fullPostPageAdmin3.png)

![fullPostPageAdmin_resp_1](uploads/65e563abc22bd3c051c4a471c9cc90bb/fullPostPageAdmin_resp_1.png)

![fullPostPageAdmin_resp_2](uploads/ea3272ea793814d31b6914b8fb57be17/fullPostPageAdmin_resp_2.png)

![fullPostPageAdmin_resp_3](uploads/33f6e82224ae53fe8407905af5cc17e9/fullPostPageAdmin_resp_3.png)

![fullPostPageAdmin_resp_4](uploads/4760043614bafdfacbc5850ae9bb85a6/fullPostPageAdmin_resp_4.png)

![fullPostPageAdmin_resp_5](uploads/d4de9e99b8258d8781e5568c320be9d3/fullPostPageAdmin_resp_5.png)

