import { Tooltip } from '@mui/material';
import { RouteMapItem } from 'lib/router/routeMapParser';
import { withRouter, RouteComponentProps } from 'react-router-dom';
import { StyledTableRowLink } from '../Table/ContentTable.styles';
import buildLink from './BuildLink';

type ChildEntityLinksProps = RouteComponentProps & {
  childEntities: Array<RouteMapItem>,
  row: Record<string, any>,
}

const ChildEntityLinks = (props: ChildEntityLinksProps): JSX.Element => {

  const { childEntities, row, match } = props;

  return (
    <>
        {childEntities.map((routeMapItem, key: number) => {
            const icon = routeMapItem.entity?.icon as JSX.Element;
            const title = routeMapItem.entity?.title as JSX.Element;
            const link = buildLink(routeMapItem.route || '', match, row.id);

            return (
                <Tooltip key={key} title={title} placement="bottom">
                    <StyledTableRowLink to={link}>
                        {icon}
                    </StyledTableRowLink>
                </Tooltip>
            );
        })}
    </>
  );
}

export default withRouter(ChildEntityLinks);