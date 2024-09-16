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
import {
  WebPortalPropertiesList,
  WebPortalPropertyList,
} from 'entities/WebPortal/WebPortalProperties';
import { useStoreState } from 'store';

const Impersonate: ActionFunctionComponent = (props: ActionItemProps) => {
  const { row, variant = 'icon', entityService } = props;
  const token = useStoreState((state) => state.auth.token);
  const customData = useStoreState(
    (state) => state.list.customData
  ) as WebPortalPropertiesList;

  if (!row) {
    return null;
  }

  if (customData === undefined) {
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

  const { id } = row;
  const impersonationUrl = customData.find(
    (data: WebPortalPropertyList) => data.brand === row.id
  )?.url;

  const url = impersonationUrl ?? '';

  const queryString = `target=${id}&token=${token}`;

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
