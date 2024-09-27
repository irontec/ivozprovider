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
import { WebPortalPropertiesList } from 'entities/WebPortal/WebPortalProperties';
import { useStoreState } from 'store';

const Impersonate: ActionFunctionComponent = (props: ActionItemProps) => {
  const { row, entityService, variant = 'icon' } = props;
  const token = useStoreState((state) => state.auth.token);
  const customData = useStoreState((state) => state.list.customData);
  const profile = useStoreState((state) => state.clientSession.aboutMe.profile);
  const canImpersonate = profile?.canImpersonate;

  if (!row) {
    return null;
  }

  const { username, active } = row;
  const isActionDisabled = customData === undefined || !active;

  if (isActionDisabled || !canImpersonate) {
    return (
      <>
        {variant === 'text' && (
          <MoreMenuItem disabled={true}>{_('Impersonate')}</MoreMenuItem>
        )}
        {variant === 'icon' && (
          <Tooltip
            title={_('Impersonate')}
            placement='bottom-start'
            enterTouchDelay={0}
          >
            <span>
              <StyledTableRowCustomCta disabled={true}>
                <AdminPanelSettingsIcon />
              </StyledTableRowCustomCta>
            </span>
          </Tooltip>
        )}
      </>
    );
  }

  const companyUrl = customData.find(
    (data: WebPortalPropertiesList) => data.company === row.companyId
  )?.url;

  const brandUrl = customData.find(
    (data: WebPortalPropertiesList) => data.company === null
  )?.url;

  const impersonationUrl = companyUrl ? companyUrl : brandUrl;
  const url = impersonationUrl ?? '';

  const queryString = `username=${username}&token=${token}`;

  return (
    <StyledTableRowChildEntityLink
      to={`${url}/client/?${queryString}`}
      parentEntity={entityService.getEntity()}
      parentRow={row}
      target='_impersonate-client'
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
