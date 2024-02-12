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
import AdminPanelSettingsIcon from '@mui/icons-material/AdminPanelSettings';
import { Tooltip } from '@mui/material';
import { useStoreState } from 'store';

const Impersonate: ActionFunctionComponent = (props: ActionItemProps) => {
  const { row, variant = 'icon', entityService } = props;
  const token = useStoreState((state) => state.auth.token);

  if (!row) {
    return null;
  }

  const { username } = row;
  const queryString = `username=${username}&token=${token}`;

  return (
    <StyledTableRowChildEntityLink
      to={`/brand/?${queryString}`}
      parentEntity={entityService.getEntity()}
      parentRow={row}
      target='_impersonate-brand'
    >
      <>
        {variant === 'text' && <MoreMenuItem>{_('Impersonate')}</MoreMenuItem>}
        {variant === 'icon' && (
          <Tooltip
            title={_('Impersonate')}
            placement='bottom-start'
            enterTouchDelay={0}
          >
            <StyledTableRowCustomCta>
              <AdminPanelSettingsIcon />
            </StyledTableRowCustomCta>
          </Tooltip>
        )}
      </>
    </StyledTableRowChildEntityLink>
  );
};

export default Impersonate;
