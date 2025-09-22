# sv

Everything you need to build a Svelte project, powered by [`sv`](https://github.com/sveltejs/cli).

## Creating a project

If you're seeing this, you've probably already done this step. Congrats!

```bash
# create a new project in the current directory
npx sv create

# create a new project in my-app
npx sv create my-app
```

## Developing

Once you've created a project and installed dependencies with `npm install` (or `pnpm install` or `yarn`), start a development server:

```bash
npm run dev

# or start the server and open the app in a new browser tab
npm run dev -- --open
```

## Building

To create a production version of your app:

```bash
npm run build
```

You can preview the production build with `npm run preview`.

> To deploy your app, you may need to install an [adapter](https://svelte.dev/docs/kit/adapters) for your target environment.


## CI/CD Pipeline Overview

This project uses GitHub Actions for Continuous Integration and Continuous Deployment (CI/CD).


### Pipeline Workflow

The CI/CD pipeline is triggered on every push to the `main`/`release/deployment-branch` branch and includes the following steps:

1. **Checkout Code**: GitHub Actions checks out the code from the repository.
2. **Set up Node.js**: The pipeline installs the necessary Node.js version and dependencies.
3. **Run Tests (Not yet implemented)**: Unit tests are run using a testing framework (e.g., Jest, Mocha).
4. **Build Application**: The application is built using the `npm run build` command.
5. **Deploy (Not yet implemented)**: If the tests pass and the build is successful, the application is deployed to the production environment.
6. **Notify**: The pipeline sends notifications (e.g., via Slack or email) if the build or deployment fails.

### Triggering

The pipeline is triggered by:
- **Pushes** to the `main`/`release/deployment-branch` branch.
- **Pull Requests** to the `main`/`release/deployment-branch` branch.

## CI/CD Pipeline Sequence Diagram

```mermaid
sequenceDiagram
    participant Developer
    participant GitHub Actions
    participant Build Server

    Developer->>GitHub Actions: Pushes code
    GitHub Actions->>Build Server: Builds and tests application
    Build Server-->>GitHub Actions: Build and test results
    GitHub Actions-->>Developer: Notifies about success/failure

