**Studentnummer**: 473157

---

# Final exam in IMT2291 - Web Technologies

## Notes

* Task 1 through 10 I would consider finished.
* Task 4 has an error. See TODO below.
* Task 11 I only got about half-way through. See note in `tree-viewer.html`.


## TODO

The following items are things I would like to have done, but skipped because of time-constraints, or forgot to do while I was doing the task:

* Add htmlspecialcharacters to input from user
* add min max to html input tags
* check if flighttime input field is correctly filled out (is string of form xx:xx:xx)
* **Task 4**: Improve progress bar. It works, but is a little janky
* Task 4 has an error when fetching thumbnail. Thumbnail with 'id' equal to a 'craftid' is fetched.. Confused what keys were to what. Don't have time to rewrite function, so I'm leaving it as is. Ideally I would solve this using the DB->getAircraftThumbnails function I introduced for a later task, in combination with a DB->getThumbnail function.
* **Task 5**: Make verification code include characters
* **Task 9**: Dynamically fill cells dropdown
