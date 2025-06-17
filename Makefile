.PHONY: help

help: ## Print help
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n\nTargets:\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-10s\033[0m %s\n", $$1, $$2 }' $(MAKEFILE_LIST)
pwd:
	${CURDIR}

run: ## Run code using docker :: make run filepath=pathtofile 
ifndef filepath
	$(error "Defina filepath=...")
endif
	docker run --rm --network rabbitmq-test-network -v .:/app php84cli:herberth php $(filepath) $(args)
