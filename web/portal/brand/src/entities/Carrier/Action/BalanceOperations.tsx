import { EntityValues } from '@irontec/ivoz-ui';
import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import useCancelToken from '@irontec/ivoz-ui/hooks/useCancelToken';
import {
  ActionFunctionComponent,
  ActionItemProps,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ReplayIcon from '@mui/icons-material/Replay';
import { Tooltip } from '@mui/material';
import { useEffect, useState } from 'react';
import { useStoreActions, useStoreState } from 'store';

import { BalanceOperationsModal } from '../../../components/BalanceOperations/BalanceOperationsModal';
import { CompanyPropertyList } from '../../Company/CompanyProperties';
import { CurrencyPropertyList } from '../../Currency/CurrencyProperties';
import Carrier from '../Carrier';

const BalanceOperations: ActionFunctionComponent = (props: ActionItemProps) => {
  const { row, variant = 'icon' } = props;

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);
  const hasBillingFeature = aboutMe?.features.includes('billing') ?? false;

  const [amountChoice, setAmountChoice] = useState('+');
  const [amountValue, setAmountValue] = useState('0.00');
  const [open, setOpen] = useState(false);
  const [currencySymbol, setCurrencySymbol] = useState('');
  const apiPost = useStoreActions((actions) => {
    return actions.api.post;
  });
  const cancelToken = useCancelToken();

  const apiGet = useStoreActions((actions) => {
    return actions.api.get;
  });
  const reload = useStoreActions((actions) => {
    return actions.list.reload;
  });
  useEffect(() => {
    apiGet({
      path: `${Carrier.path}/${row.id}`,
      params: {},
      successCallback: async (value) => {
        const typedValue = value as CompanyPropertyList<EntityValues>;
        if (!typedValue.currency) {
          return;
        }

        const { symbol } = typedValue.currency as CurrencyPropertyList<
          string | null
        >;
        setCurrencySymbol(symbol ?? '');

        return;
      },
      cancelToken: cancelToken[1],
    });
  }, [setCurrencySymbol, row.id, apiGet, cancelToken]);

  const handleClickOpen = () => {
    if (!hasBillingFeature) {
      return;
    }
    setOpen(true);
  };

  const handleClose = () => {
    setOpen(false);
  };

  const handleSend = () => {
    const operation = amountChoice === '+' ? 'increment' : 'decrement';

    apiPost({
      path: `${Carrier.path}/${row.id}/modify_balance`,
      values: {
        operation,
        amount: amountValue,
      },
      contentType: 'application/x-www-form-urlencoded',
    }).then(() => {
      setOpen(false);
      reload();
    });
  };

  if (!row || !hasBillingFeature) {
    return null;
  }

  if (!row.calculateCost) {
    return (
      <MoreMenuItem>
        <a className='disabled'>{_('Balance Operations')}</a>
      </MoreMenuItem>
    );
  }

  return (
    <>
      {variant === 'text' && (
        <MoreMenuItem onClick={handleClickOpen}>
          {_('Balance Operations')}
        </MoreMenuItem>
      )}
      {variant === 'icon' && (
        <Tooltip
          title={_('Balance Operations')}
          placement='bottom-start'
          enterTouchDelay={0}
        >
          <StyledTableRowCustomCta>
            <ReplayIcon onClick={handleClickOpen} color='primary' />
          </StyledTableRowCustomCta>
        </Tooltip>
      )}
      {open && (
        <BalanceOperationsModal
          open={open}
          onClose={handleClose}
          onSend={handleSend}
          amountChoice={amountChoice}
          onAmountChoiceChange={setAmountChoice}
          amountValue={amountValue}
          onAmountValueChange={setAmountValue}
          currencySymbol={currencySymbol}
        />
      )}
    </>
  );
};

export default BalanceOperations;
