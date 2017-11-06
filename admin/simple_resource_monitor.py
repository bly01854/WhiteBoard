import psutil, json

def cpu_monitor():
    cpu_usage = psutil.cpu_percent(1)
    return cpu_usage;

def memory_monitor():
    memory_used = psutil.virtual_memory().available
    memory_total = psutil.virtual_memory().total
    memory_available = float(memory_used) / float(memory_total)
    memory_usage = round((1 - memory_available) * 100, 2)
    return memory_usage

def disk_monitor():
    disk_percent = psutil.disk_usage('/').percent
    return disk_percent


def main():
    statistics=[cpu_monitor(),memory_monitor(), disk_monitor()]
    print json.dumps(statistics)

if __name__ == "__main__":
    main()




