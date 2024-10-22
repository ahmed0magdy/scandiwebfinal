import { Button } from "react-bootstrap";

export interface NavbarButtonProps {
  text: string;
  variant: string;
  onClick: () => void;
  className?: string;
  disable?: boolean;
}

const NavbarButton = ({
  text,
  variant,
  onClick,
  className,
  disable,
}: NavbarButtonProps) => {
  return (
    <Button
      variant={variant}
      onClick={onClick}
      className={className}
      disabled={disable}
    >
      {text}
    </Button>
  );
};

export default NavbarButton;
