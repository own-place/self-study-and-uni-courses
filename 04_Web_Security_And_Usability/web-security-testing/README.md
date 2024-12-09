# Testing

**Author:** Luyue Zhang
**Student Number:** 00095271

## User Stories

### User Story 01: Upload my personal details

#### Happy Path:

**Given:** I log in with my account and find a form option on the navigation bar. I click it and see a form named 'Student Info'.
**When:** I fill in my personal details here and click the 'Submit' button to upload the information.
**Then:** The browser redirects to the home page and displays a message confirming that my form was submitted successfully.

#### Unhappy Path:

**When:** Nothing happens after I click the 'Submit' button.
**Then:** I click the 'back' arrow in the top left corner of my browser to return to the previous page. I then send an email to the department to report this issue.

### User Story 02: Leave notes on the platform

#### Happy Path:

**Given:** I type something into the input box, including title and content fields.
**When:** I click the 'Submit' button after filling in these fields.
**Then:** The note I just submitted appears below the text 'Things you left here' on the page. I can edit and update all the notes here.

#### Unhappy Path:

**When:** Nothing happens after clicking the button. I am not sure if my note was saved successfully.
**Then:** I click the ‘back’ arrow on the top left corner of my browser and go back to the previous page. I send an email to the department for reporting this.

## Test Plan

### User Story 01: Upload my personal details

#### System Test

- **Happy Path:** Verify that upon clicking the 'Submit' button after filling in personal details, the form will be stored with the validated data.
- **Unhappy Path:** Verify that nothing happens upon clicking the 'Submit' button.

#### Unit Test

- Test the function that handles form submission.

### User Story 02: Leave notes on the platform

#### System Test

- **Happy Path:** Verify that after filling in the title and content fields and clicking the 'Submit' button, the newly submitted note will be stored into database.
- **Unhappy Path:** Verify that no data will be stored into database.

#### Unit Test

- Test the function that saves the note submitted by the user into the database.
- Test the function that retrieves the list of notes from the database and displays them correctly on the platform. All the notes could be edited, updated and deleted.

## Apply the V-Model to the User Stories

### User Story 01: Upload my personal details

- **Requirement Analysis:** Verify that the requirements for uploading personal details via a form are clear.
- **System Design:** Design the 'Student Info' form interface and backend service. Specify how personal details will be stored securely and accessed by authorized personnel.
- **Unit Testing:** Test individual functions responsible for form submission. Verify that data entered by the student is correctly processed and stored.
- **Integration Testing:** Ensure the form submission function integrates correctly with backend services.
- **System Testing:** Test the overall functionality of the 'Student Info' form.
- **Acceptance Testing:** Validate that the form submission meets the university's administrative needs.

### User Story 02: Leave notes on the platform

- **Requirement Analysis:** Verify requirements for leaving and managing notes on the platform are clear.
- **System Design:** Design the UI components for leaving notes (title, content input fields, submit button). Define backend services for saving, retrieving, updating, and deleting notes.
- **Unit Testing:** Test functions responsible for saving notes to the database. Verify correct retrieval and display of notes on the platform.
- **Integration Testing:** Ensure note-saving functions integrate seamlessly with backend services. Validate that notes appear correctly on the platform after submission.
- **System Testing:** Test the overall functionality of the notes feature on the platform. Confirm that notes are managed correctly (creation, retrieval, updating, deletion).
- **Acceptance Testing:** Validate that the notes feature meets student needs for academic and personal use. Ensure all functionalities related to notes (creation, viewing, editing, deletion) work as expected.

## Test Result

### User Story 01: Upload my personal details

![`StudentControllerSystemTest`](public/image/StudentControllerSystemTest.png)
![`StudentControllerTest`](public/image/StudentControllerTest.png)

### User Story 02: Leave notes on the platform

![`NoteControllerSystemTest`](public/image/NoteControllerSystemTest.png)
![`NoteControllerTest`](public/image/NoteControllerTest.png)

## Evaluation

### Possible Mistake/Error Detected by the Tests

- **For User Story One (Upload my personal details):** Tests can detect if clicking the 'Submit' button after filling in personal details, the form could be stored with the validated data or not.
- **For User Story Two (Leave notes on the platform):** Tests can detect after filling in the title and content fields and clicking the 'Submit' button, the newly submitted note could be stored into database or not.

### Possible Mistake/Error Not Detected by the Tests

- **For User Story One (Upload my personal details):** They might miss performance issues such as slow loading times for the 'Student Info' form or backend processing delays. Non-functional aspects like security vulnerabilities in handling personal details might not be thoroughly tested.
- **For User Story Two (Leave notes on the platform):** Tests might not detect issues like delays in loading existing notes or responsiveness issues in the UI when managing notes. Non-functional aspects such as scalability issues with the note storage or usability problems in the note management interface could be overlooked.

### Conclusion

These test plans ensure thorough coverage of functional scenarios in the user stories using the V-Model. It validates every component, including unit tests for individual functions and system tests for integrated behavior, against specified requirements. However, it focuses primarily on functional correctness and basic user interactions. It does not adequately address non-functional aspects such as performance, security, and usability beyond basic functionality. Therefore, additional testing, like performance testing for speed issues, security testing for data vulnerabilities, and usability testing for user experience, is necessary for a more comprehensive validation of the application's quality and user satisfaction.
