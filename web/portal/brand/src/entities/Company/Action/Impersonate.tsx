import { MoreMenuItem } from '@irontec-voip/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import {
  StyledTableRowChildEntityLink,
  StyledTableRowCustomCta,
} from '@irontec-voip/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import {
  ActionFunctionComponent,
  ActionItemProps,
} from '@irontec-voip/ivoz-ui/router/routeMapParser';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import AdminPanelSettingsIcon from '@mui/icons-material/AdminPanelSettings';
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
