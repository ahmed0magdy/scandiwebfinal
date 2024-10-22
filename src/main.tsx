import * as ReactDOM from "react-dom/client";
import { ApolloProvider } from "@apollo/client";
import apolloClient from "./services/apollo-client";
import { RouterProvider } from "react-router-dom";
import router from "./routes";
import React from "react";
import "bootstrap/dist/css/bootstrap.min.css";
import "./index.css";

const root = ReactDOM.createRoot(
  document.getElementById("root") as HTMLElement
);

root.render(
  <React.StrictMode>
    <ApolloProvider client={apolloClient}>
      <RouterProvider router={router} />
    </ApolloProvider>
  </React.StrictMode>
);
