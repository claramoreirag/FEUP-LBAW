# Collaborative News - lbaw2154

GreeNews intends to promote an online information system that can compile news from several collaborators about sustainability and the environment. This platform will be available to everyone interested in the environmental cause. It will stand out from similar platforms since our priority is to ensure the safety and accuracy of posted news.

**Link to the release with the final version of the source code in the group's git repository:** https://git.fe.up.pt/lbaw/lbaw2021/lbaw2154

**Link for the production image:** http://lbaw2154.lbaw-prod.fe.up.pt/

**Administration Credentials**

| Email | Password |
|----------|----------|
| clara.moreira@gmail.com | 123456CA |
| flavia.carvalhido@gmail.com | 123456FL |

**User Credentials**

| Type | Email | Password |
|------|----------|----------|
| basic account | joao.rosario@gmail.com | pipoca123 |
| basic account | bernardo.ramalho@gmail.com  | bernardinho |


To run the project image locally tun the following command:
```
docker run -it -p 8000:80 lbaw2076/lbaw2076
```


#### Run PostgresSQL local server

```
docker-compose up
```

#### Run database

```
php artisan db:seed
```

#### Run laravel php local server

```
php artisan serve
```

### Team
- Clara Gadelho, up201806309@g.uporto.pt
- Flávia Carvalhido, up201806857@g.uporto.pt
- Leonor Gomes, up201806567@g.uporto.pt
- Mariana Ramos, up201806869@g.uporto.pt

GROUP54, 09/02/2021
