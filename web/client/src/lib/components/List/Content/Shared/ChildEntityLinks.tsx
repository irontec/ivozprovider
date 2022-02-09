import { Tooltip } from '@mui/material';
import { RouteMapItem } from 'lib/router/routeMapParser';
import { withRouter, RouteComponentProps } from 'react-router-dom';
import { StyledTableRowEntityCta } from '../Table/ContentTable.styles';
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
            const Icon = routeMapItem.entity?.icon as React.FunctionComponent;
            const title = routeMapItem.entity?.title as JSX.Element;
            const link = buildLink(routeMapItem.route || '', match, row.id);

            return (
                <Tooltip
                  key={key}
                  title={title}
                  placement="bottom-start"
                  enterTouchDelay={0}
                >
                    <StyledTableRowEntityCta to={link}>
                        <Icon />
                    </StyledTableRowEntityCta>
                </Tooltip>
            );
        })}
    </>
  );
}

export default withRouter(ChildEntityLinks);