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

### Testing the Work Queue

To test the work queue functionality:

* **Shell 1 (Worker):** Run the worker to listen for and process tasks.
    ```bash
    make run filepath=src/task-work/worker.php
    ```
* **Shell 2 (Task Producer):** Send a task to the queue.
    ```bash
    make run filepath=src/task-work/task.php args=2
    ```


