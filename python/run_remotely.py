import subprocess

"""
Write a function or script that takes two arguments (list of servers, command) and runs command on each of the servers.
Usage:
    run_remotely(['server1', 'server2'], "df -h")
"""


def run_remotely(servers=[], command='', dry_run=True):
    """
    Run command on remote servers and print the results
    Assume current public key has ssh access to servers
    """

    # TODO: Add validation, dry run functionality and handle server failures
    for server in servers:
        command_list = ["ssh", server, command]
        print(f"Running command: {' '.join(command_list)}")
        result = subprocess.run(command_list, stdout=subprocess.PIPE)
        print(result)


run_remotely(['127.0.0.1'], 'df -h')
