
<div align="center">
  <img src="samknows.png" align="center" width="60">
  <h1 align="center">SamKnows Backend Engineering Test</h1>
</div>

## Summary

This project has two test cases you need to make pass.

1. Displaying the min, max, median and average for a data set.
2. Discover under-performing periods of download performance.

We don't expect it'll take you more than an two hours to do. If you do submit it
without doing everything you'd like to do, then add a TODO file in root with the changes
you'd like to make and document any assumptions made during the implementation.

## Data
In the data provided, dtime represents the date of the measurement and metricValue represents 
the measurement in bytes per second.

## What we're looking for

This is a quick test put together by the backend team at SamKnows to test your skills in writing clear
business logic and testing code (functional and unit). We've setup a base project using [Symfony 4](https://symfony.com) with [Flex](https://symfony.com/doc/current/setup/flex.html) and
[Docker](https://www.docker.com). 

Your task is to:

1. Write well structured code to pass the failing test suite.
2. Write unit tests to cover your new code.
3. Write clear and concise commit messages.
4. Conform to [PSR-2](https://www.php-fig.org/psr/psr-2/) standards and pass [phpstan](https://github.com/phpstan/phpstan)'s strict checks.
5. Remember this repository is a base, modify it how you see fit!

We're also looking for accurate phpDocs where appropriate.

## Starting

The failing test: [AppAnalyseMetricsCommandTest](tests/Functional/Command/AppAnalyseMetricsCommandTest.php)
is where you need to be starting, you'll also find detailed comments as well as references to the inputs and expected
output. Look at [#testing](Testing) section to see how you'll run the tests.

## Testing

Ensure you've got Docker Compose installed, then run:

``` bash
make test
```

to run the test suite. You can also use

``` bash
make shell
```

to jump into the container to run composer, etc ...


## Conclusion

Good luck, we hope to hear from you soon!
