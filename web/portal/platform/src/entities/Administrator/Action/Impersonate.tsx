import { EntityValue } from '@irontec/ivoz-ui';
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

import { WebPortalPropertiesList } from '../../WebPortal/WebPortalProperties';
import { AdministratorPropertyList } from '../AdministratorProperties';

const Impersonate: ActionFunctionComponent = (props: ActionItemProps) => {
  type InputProps = Omit<ActionItemProps, 'row'> & {
    row: AdministratorPropertyList<EntityValue>;
  };
  const { row, variant = 'icon', entityService }: InputProps = props;
  const token = useStoreState((state) => state.auth.token);
  const customData = useStoreState(
    (state) => state.list.customData
  ) as WebPortalPropertiesList;

  if (!row) {
    return null;
  }

  const { username, active } = row;
  const isActionDisabled = customData === undefined || !active;

  if (isActionDisabled) {
    return (
      <>
        {variant === 'text' && (
          <MoreMenuItem disabled={true}>{_('Impersonate')}</MoreMenuItem>
        )}
        {variant === 'icon' && (
          <StyledTableRowCustomCta disabled={true}>
            <AdminPanelSettingsIcon />
          </StyledTableRowCustomCta>
        )}
      </>
    );
  }

  const impersonationUrl = customData[0]?.url;
  const url = impersonationUrl ?? '';

  const queryString = `username=${username}&token=${token}`;

  return (
    <StyledTableRowChildEntityLink
      to={`${url}/brand/?${queryString}`}
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
