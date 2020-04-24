<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>



## About Laravel GraphQL

 This is a sample Laravel project to illustrate API creation using GraphQL using [grapgql-laravel](https://github.com/rebing/graphql-laravel) package
 
 ## Set up 
 
 Clone the project  then;
 
 ```bash
composer install

cp .env.example .env

php artisan key:generate

php artisan migrate 

php artisan serve

```

## Sample Urls

### 1. Create user 
#### Request
http://localhost:8000/graphql/auth
```
mutation {
    signUp(
    name: "tester"
    email:"123@test.com"
    password:"123"
  ) {
    id,
    email,
    name,
    api_token
  }
}

```

#### Response 
```json
{
    "data": {
        "signUp": {
            "id": 1,
            "email": "123@test.com",
            "name": "tester",
            "api_token": "09SBifku0BCSNS7VBFNqQg0goDYqCX43tL4pNtl7lJPmVOJOjDdjD42mnmuOLBybwW7DHZmrnVTey0p8nH4EWGGa7oRKErnZMm9c"
        }
    }
}
```

### 2. Login

http://localhost:8000/graphql/auth
#### Request
```
mutation {
    logIn(
    email:"123@test.com"
    password:"123"
  ) {
    id,
    email,
    name,
    api_token
  }
}
```

#### Response 
```json
{
    "data": {
        "logIn": {
            "id": 1,
            "email": "123@test.com",
            "name": "tester",
            "api_token": "09SBifku0BCSNS7VBFNqQg0goDYqCX43tL4pNtl7lJPmVOJOjDdjD42mnmuOLBybwW7DHZmrnVTey0p8nH4EWGGa7oRKErnZMm9c"
        }
    }
}
```

### 3. Get Bits

http://localhost:8000/graphql

#### Request 
```
 mutation {
      newBit (snippet: "<?php ehco phpinfo(); ?>") {
        id
        user {
          id
          name
        }
        snippet
        created_at
        updated_at
      }
    }
```
#### Response 
```json
{
    "data": {
        "newBit": {
            "id": 2,
            "user": {
                "id": 1,
                "name": "tester"
            },
            "snippet": "<?php ehco phpinfo(); ?>",
            "created_at": "2020-04-16 18:27:07",
            "updated_at": "2020-04-16 18:27:07"
        }
    }
}

```

### 4. Update Avatar
http://localhost:8000/graphql
#### Request 

```
mutation($file: Upload!) 
{ UpdateUserProfilePhoto(profilePicture: $file)
    {
     id,
     name,
     avatar,
     email,
     api_token
    } 
}
```



## Resources

The sample project is created from serries of lessons from;
1. [Auth0 Blog](https://auth0.com/blog/developing-and-securing-graphql-apis-with-laravel/)

2. [Pusher Blog](https://blog.pusher.com/building-apis-laravel-graphql/)

## About Me
[Magak](https://magak.me)
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

[![license](https://img.shields.io/github/license/mashape/apistatus.svg?style=for-the-badge)](#)

[![Open Source Love](https://badges.frapsoft.com/os/v2/open-source-200x33.png?v=103)](#)
