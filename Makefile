project := jobhub
image := jobhub
tag := latest
repo_or_dir := $$PWD

builder_image := laravel-builder
runtime_image := laravel-runtime

# Prepare the S2I builder and runtime images
.PHONY: s2i
s2i:
	docker build -t ${project}/${builder_image}:${tag} -f s2i/Dockerfile.builder s2i
	docker build -t ${project}/${runtime_image}:${tag} -f s2i/Dockerfile.runtime s2i

# Create a runnable docker image
.PHONY: runnable-image
runnable-image:
	s2i build \
		--runtime-artifact=/tmp/laravel.tgz:. \
		--runtime-image=${project}/${runtime_image}:${tag} \
		${repo_or_dir} \
		${project}/${builder_image}:${tag} \
		${project}/${image}:${tag}

.PHONY: publish
publish:
	docker tag  ${project}/${image}:${tag} ${registry}/${project}/${image}:${tag}
	docker push ${registry}/${project}/${image}:${tag}		