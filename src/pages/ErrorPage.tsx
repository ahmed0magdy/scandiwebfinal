import { isRouteErrorResponse, useRouteError } from "react-router-dom";

const ErrorPage = () => {
  const error = useRouteError();

  return (
    <>
      <h1>Oh no! Something went wrong.</h1>
      <p>
        {isRouteErrorResponse(error)
          ? "This page doesn't exist."
          : "Sorry, an error occurred on this page."}
      </p>
    </>
  );
};

export default ErrorPage;
