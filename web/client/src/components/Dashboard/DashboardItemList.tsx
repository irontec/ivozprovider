import StyledDashboardLink from './DashboardItemList.styles';
import { RouteMapItem } from '@irontec/ivoz-ui/router/routeMapParser';

const DashboardItemList = (props: { items: RouteMapItem[] }): JSX.Element => {

  const { items } = props;

  return (
        <ul>
            {items.map((item: RouteMapItem, key: number) => {

              const { route, entity } = item;

              if (!entity) {
                return null;
              }

              if (!entity.acl.read) {
                return null;
              }

              return (
                    <li key={key}>
                        <StyledDashboardLink to={route}>
                            <entity.icon />
                            {entity.title}
                        </StyledDashboardLink>
                    </li>
              );
            })}
        </ul>
  );
};

export default DashboardItemList;