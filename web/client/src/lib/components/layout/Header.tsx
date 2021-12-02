import CollapsedBreadcrumbs from './CollapsedBreadcrumbs';
import { StyledAppBar, StyledHeaderContainer, StyledToolbar } from './Header.styles';

interface headerProps {
  loggedIn: boolean
}

export default function Header(props: headerProps): JSX.Element {

  const { loggedIn } = props;

  return (
    <StyledHeaderContainer>
      <StyledAppBar position="absolute">
        <StyledToolbar>
          {loggedIn && <CollapsedBreadcrumbs />}
        </StyledToolbar>
      </StyledAppBar>
    </StyledHeaderContainer>
  );
}