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
import { CompanyPropertyList } from 'entities/Company/CompanyProperties';
import { CurrencyPropertyList } from 'entities/Currency/CurrencyProperties';
import { useEffect, useState } from 'react';
import { useStoreActions } from 'store';

import { BalanceOperationsModal } from '../../../components/BalanceOperations/BalanceOperationsModal';

const BalanceOperations: ActionFunctionComponent = (props: ActionItemProps) => {
  const { row, variant = 'icon' } = props;
  const [amountChoice, setAmountChoice] = useState('+');
  const [amountValue, setAmountValue] = useState('0.00');
  const [open, setOpen] = useState(false);
  const [currencySymbol, setCurrencySymbol] = useState('');
  const apiPost = useStoreActions((actions) => {
    return actions.api.post;
  });

  const apiGet = useStoreActions((actions) => {
    return actions.api.get;
  });
  const reload = useStoreActions((actions) => {
    return actions.list.reload;
  });
  const cancelToken = useCancelToken();

  useEffect(() => {
    apiGet({
      path: `/companies/${row.id}/balances`,
      params: {},
      successCallback: async (value: CompanyPropertyList<EntityValues>) => {
        const { symbol } = value.currency as CurrencyPropertyList<EntityValues>;
        setCurrencySymbol(symbol ?? '');

        return;
      },
      cancelToken: cancelToken[1],
    });
  }, [setCurrencySymbol, row.id, apiGet, cancelToken]);

  if (!row) {
    return null;
  }

  const handleClickOpen = () => {
    setOpen(true);
  };

  const handleClose = () => {
    setOpen(false);
  };

  const handleSend = () => {
    const operation = amountChoice === '+' ? 'increment' : 'decrement';

    apiPost({
      path: `/companies/${row.id}/modify_balance`,
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
