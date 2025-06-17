# RabbitMQ POC

This project demonstrates a basic Proof of Concept (POC) for RabbitMQ.

---

## 1. Getting Started

To get the RabbitMQ service up and running, navigate to the project's root directory and execute the following command:

```bash
docker compose up
```

2. how to run scripts:

```bash
make run filepath=path-to-file args=params
```

testing work queue:
    * shell 1: make run filepath=src/task-work/worker.php
    * shell 2 :make run filepath=src/task-work/task.php args=2 


