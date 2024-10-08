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
import { WebPortalPropertyList } from 'entities/WebPortal/WebPortalProperties';
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

  if (customData === undefined || !canImpersonate) {
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

  const { id } = row;
  const queryString = `target=${id}&token=${token}`;

  const companyUrl = customData.find(
    (data: WebPortalPropertyList) => data.company === row.id
  )?.url;

  const brandUrl = customData.find(
    (data: WebPortalPropertyList) => data.company === null
  )?.url;

  const impersonationUrl = companyUrl ? companyUrl : brandUrl;
  const url = impersonationUrl ?? '';

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
