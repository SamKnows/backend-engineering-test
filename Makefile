.PHONY: test shell

test:
	docker-compose run --rm test

shell:
	docker-compose run --rm shell
