import { ReactNode } from "react";
import "./Header.scss";
interface IHeaderProps {
  pageTitle: string;
  children?: ReactNode;
}

const Header = ({ pageTitle, children }: IHeaderProps) => {
  return (
    <div className="header">
      <div className="header__title">{pageTitle}</div>
      <div className="header__buttons">{children}</div>
    </div>
  );
};

export default Header;
