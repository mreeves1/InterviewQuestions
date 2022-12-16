import pprint
import requests

"""
Find all the repos in a given org and print out their workflow names and badge url
example workflow: https://github.com/actions/starter-workflows/actions/workflows/auto_assign.yml
output structure: { "repo_name_1": [ {"workflow_name_1": "workflow_badge_1"} ] }
"""

# TODO: Add try/catch around http requests and possibly cache request result
base_url = "https://api.github.com"
org = "actions"
# Choose page 2/2 to conserve api calls & prevent throttling
response1 = requests.get(f"{base_url}/orgs/{org}/repos?page=2")
repos = response1.json()
result = {}

for repo in repos:
    name = repo['name']
    result[name] = []
    response2 = requests.get(f"{base_url}/{org}/{name}/actions/workflows")
    workflows = response2.json()['workflows']
    for workflow in workflows:
        wf_dict = {workflow['name']: workflow['badge_url']}
        result[name].append(wf_dict)

pp = pprint.PrettyPrinter(depth=4)
pp.pprint(result)
