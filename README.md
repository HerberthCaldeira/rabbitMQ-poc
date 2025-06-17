1. Rabbit service up:
    docker compose up

2. how to run scripts:
´´´sh
make run filepath=path-to-file args=params


testing work queue:
    shell 1: make run filepath=src/task-work/worker.php
    shell 2 :make run filepath=src/task-work/task.php args=2 


