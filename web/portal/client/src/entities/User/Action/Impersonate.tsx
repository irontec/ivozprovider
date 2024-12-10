import { ActionItemProps } from '@irontec/ivoz-ui';
import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowChildEntityLink } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { useStoreState } from 'store';

const Impersonate = (props: ActionItemProps) => {
  const { row, entityService, variant = 'icon' } = props;
  const { email, active } = row;
  const token = useStoreState((state) => state.auth.token);
  const queryString = `token=${token}&email=${email}`;

  if (!active) {
    return (
      <>
        {variant === 'text' && (
          <MoreMenuItem disabled={true}>{_('Impersonate')}</MoreMenuItem>
        )}
      </>
    );
  }

  return (
    <StyledTableRowChildEntityLink
      to={`/user/?${queryString}`}
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
