import { RouteMap } from 'lib/router/routeMapParser';
import Breadcrumbs from './Breadcrumbs';
import { StyledAppBar, StyledHeaderContainer, StyledToolbar } from './Header.styles';

interface headerProps {
  loggedIn: boolean,
  routeMap: RouteMap
}

export default function Header(props: headerProps): JSX.Element {

  const { loggedIn, routeMap } = props;

  return (
    <StyledHeaderContainer>
      <StyledAppBar position="fixed">
        <StyledToolbar>
          {loggedIn && <Breadcrumbs routeMap={routeMap} />}
        </StyledToolbar>
      </StyledAppBar>
    </StyledHeaderContainer>
  );
}