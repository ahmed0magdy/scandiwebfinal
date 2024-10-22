import { Navbar as BootstrapNavbar, Container } from "react-bootstrap";
import NavbarButton, { NavbarButtonProps } from "./Button";

interface NavbarProps {
  title: string;
  leftButton?: NavbarButtonProps;
  rightButton?: NavbarButtonProps;
}

const Navbar = ({ title, leftButton, rightButton }: NavbarProps) => {
  return (
    <BootstrapNavbar bg="light" expand="lg" className="mb-4">
      <Container fluid>
        <BootstrapNavbar.Brand>{title}</BootstrapNavbar.Brand>
        <div>
          {leftButton && <NavbarButton {...leftButton} />}
          {rightButton && <NavbarButton {...rightButton} />}
        </div>
      </Container>
    </BootstrapNavbar>
  );
};

export default Navbar;
