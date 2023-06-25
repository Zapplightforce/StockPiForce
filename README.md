<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


# Hacktivist

To prevent IDOR attacks I used Laravels ORM for example if the user wants to see information about his profile it only displays information
about the currently logged-in user. This can be checked in the ProfileController.php file. 

To prevent snooping laravel uses the HTTPS protocol to encrypt the data that is being sent between the client and the server.

To prevent session hijacking laravel uses a session token that is stored in the session cookie. This token is regenerated every time the user logs in. It can be checked in the AuthenticatedSessionController.php file.

# Testing

The two user stories I tested are:

### User Story 1

As a registered user, I want to be able to log in and view the dashboard.

**Acceptance Criteria:** When I enter my correct login credentials and click on the login button,
I should be redirected to the dashboard page.

**Unhappy Path:** When I enter incorrect login credentials and click on the login button,
I should see an error message saying that the credentials are incorrect.

### User Story 2

As a registered user, I want to be able to edit my profile.

**Acceptance Criteria:** When I click on the profile button and edit my profile,
I should be able to see the changes on my profile page when I revisit it.

**Unhappy Path:** When I edit my profile without filling out the required fields,
I should see an error message saying that the fields are required.

## Wireflows

The wire flows are in a separate folder named wire flows.

## Test Plan

### User Story 1

**System Test (Happy Path):** Tests that the user can successfully log in and view the dashboard.

**System Test (Unhappy Path):** Tests that the user cannot log in with incorrect credentials and displays
an error message.

**Unit Test**: Tests that the login function successfully authenticates the user.

### User Story 2

**System Test (Happy Path):** Tests that the user can successfully navigate to the edit profile page, edit their profile
and the changes are saved and can be displayed once the user revisits them.

**System Test (Unhappy Path):** Tests that the user cannot save their edited profile without filling out the required fields.

**Unit Test**: Tests that the update function successfully updates the user's profile.

## Screenshots

The screenshots are separate in the zip folder

## Evaluation

1. **Possible mistake/error that can be detected by my tests:**
    
The tests can detect if there's an issue with the user authentication, the 
redirection after the login, and if the profile updates. For example, the test will fail if a
user tries to log in with incorrect credentials.

2.**Possible mistake/error that cannot be detected by my tests:**
    
The tests do not check for the actual content on those pages, they wouldn't detect issues
        with the display of the dashboard or profile page. They also don't test for other possible
        functionalities on the page, like password reset, registration, or fetching news.

3.**To what extent can I conclude that "everything works correctly"?:**
    
these tests make sure that the basic functions of logging in, viewing the dashboard, and 
editing the profile work correctly. However, they do not test for other functionalities
        or the actual content on the pages. For example, the tests do not check if the news
        are fetched correctly or if the user can reset their password. They also don't check
if the registration process works correctly. Meaning, while these tests are a good start, more
comprehensive tests are needed to make sure that everything works correctly. Also, these tests need to
be continuously updated as the application changes and new features are added.
