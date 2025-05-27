import { ActionItemProps } from '@irontec/ivoz-ui';
import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import {
  StyledTableRowChildEntityLink,
  StyledTableRowCustomCta,
} from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AdminPanelSettingsIcon from '@mui/icons-material/AdminPanelSettings';
import { Tooltip } from '@mui/material';
import { useCallback } from 'react';
import { useStoreState } from 'store';

type WebPortalPropertyList<T> = {
  url?: T;
  color?: T;
  urlType?: T;
  name?: T;
  id: number;
  logo?: T;
  company?: T;
  brand?: T;
};

type WebPortalPropertiesList = Array<
  WebPortalPropertyList<EntityValue | EntityValues>
>;

const Impersonate = (props: ActionItemProps) => {
  const { row, entityService, variant = 'icon' } = props;
  const { email, active } = row;
  const token = useStoreState((state) => state.auth.token);

  const urlSafeEmail = encodeURIComponent(email);
  const queryString = `token=${token}&email=${urlSafeEmail}`;
  const customData = useStoreState(
    (state) => state.list.customData as WebPortalPropertiesList | undefined
  );

  const resolvePortalUrl = useCallback(() => {
    if (customData === undefined) {
      return '';
    }
    let companyPortals = customData.filter((portal) => portal.company !== null);
    companyPortals = companyPortals.sort((a, b) => a.id - b.id);

    if (companyPortals.length > 0) {
      return companyPortals[0]?.url;
    }

    let genericPortals = customData.filter((portal) => portal.company === null);
    genericPortals = genericPortals.sort((a, b) => a.id - b.id);

    if (genericPortals.length > 0) {
      return genericPortals[0].url;
    }
  }, [customData]);

  if (!active || !customData) {
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

  const url = resolvePortalUrl() ?? '';

  return (
    <StyledTableRowChildEntityLink
      to={`${url}/user/?${queryString}`}
      parentEntity={entityService.getEntity()}
      parentRow={row}
      target='_impersonate-user'
    >
      <>
        {variant === 'text' && <MoreMenuItem>{_('Impersonate')}</MoreMenuItem>}
      </>
    </StyledTableRowChildEntityLink>
  );
};

export default Impersonate;
