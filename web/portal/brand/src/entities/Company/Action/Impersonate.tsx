import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import {
  StyledTableRowChildEntityLink,
  StyledTableRowCustomCta,
} from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import {
  ActionFunctionComponent,
  ActionItemProps,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import OpenInNewIcon from '@mui/icons-material/OpenInNew';
import { Tooltip } from '@mui/material';
import { useStoreState } from 'store';

const Impersonate: ActionFunctionComponent = (props: ActionItemProps) => {
  const { row, entityService, variant = 'icon' } = props;
  const token = useStoreState((state) => state.auth.token);

  if (!row) {
    return null;
  }

  const { id } = row;
  const queryString = `target=${id}&token=${token}`;

  return (
    <StyledTableRowChildEntityLink
      to={`/client/?${queryString}`}
      parentEntity={entityService.getEntity()}
      parentRow={row}
      // target="_impersonate-client"
    >
      <>
        {variant === 'text' && <MoreMenuItem>{_('Impersonate')}</MoreMenuItem>}
        {variant === 'icon' && (
          <Tooltip
            title={_('Impersonate as client admin')}
            placement='bottom-start'
            enterTouchDelay={0}
          >
            <StyledTableRowCustomCta>
              <OpenInNewIcon />
            </StyledTableRowCustomCta>
          </Tooltip>
        )}
      </>
    </StyledTableRowChildEntityLink>
  );
};

export default Impersonate;
