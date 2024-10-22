import React from "react";
import { Alert } from "react-bootstrap";

interface NotificationAlertProps {
  message: string | null;
  onClose: () => void;
}

const NotificationAlert: React.FC<NotificationAlertProps> = ({
  message,
  onClose,
}) =>
  message ? (
    <Alert variant="danger" onClose={onClose} dismissible>
      {message}
    </Alert>
  ) : null;

export default NotificationAlert;
