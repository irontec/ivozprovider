import ErrorMessageComponent from '@irontec/ivoz-ui/components/ErrorMessageComponent';
import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import {
  StyledTable,
  StyledTableRowCustomCta,
} from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import Modal from '@irontec/ivoz-ui/components/shared/Modal/Modal';
import {
  ActionFunctionComponent,
  ActionItemProps,
  isSingleRowAction,
  MultiSelectActionItemProps,
} from '@irontec/ivoz-ui/router/routeMapParser';
import { StyledTextField } from '@irontec/ivoz-ui/services/form/Field/TextField/TextField.styles';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import CurrencyExchangeIcon from '@mui/icons-material/CurrencyExchange';
import {
  TableBody,
  TableCell,
  TableHead,
  TableRow,
  Tooltip,
} from '@mui/material';
import { useState } from 'react';
import { useStoreActions } from 'store';

import RatingPlanGroup from '../RatingPlanGroup';

type SimulateCallResponseType = {
  plan: string;
  callDate: string;
  duration: number;
  patternName: string;
  connectionCharge: number;
  intervalStart: string;
  rate: number;
  ratePeriod: number;
  totalCost: number;
  currencySymbol: string;
};

const SimulateCall: ActionFunctionComponent = (
  props: MultiSelectActionItemProps | ActionItemProps
) => {
  const {
    selectedValues = [],
    rows = [],
    variant = 'icon',
  } = props as MultiSelectActionItemProps;
  const isSingleRow = isSingleRowAction(props);

  /* eslint-disable react-hooks/rules-of-hooks */
  if (isSingleRow) {
    return <span className='display-none'></span>;
  }

  const selectedIds =
    selectedValues.length > 0
      ? selectedValues
      : rows.map((row) => row.id.toString());

  const [open, setOpen] = useState(false);
  const [error, setError] = useState(false);
  const [errorMsg, setErrorMsg] = useState('');
  const [cost, setCost] = useState<
    Array<SimulateCallResponseType> | undefined
  >();

  const [phoneNumber, setPhoneNumber] = useState('');
  const defaultDuration = 60;
  const [duration, setDuration] = useState(defaultDuration);

  const apiPost = useStoreActions((actions) => {
    return actions.api.post;
  });
  /* eslint-enable react-hooks/rules-of-hooks */

  const handleClickOpen = () => {
    setOpen(true);
  };

  const handleClose = () => {
    setOpen(false);
    setError(false);
    setErrorMsg('');
    setPhoneNumber('');
    setDuration(defaultDuration);
    setCost(undefined);
  };

  const handleUpdate = () => {
    setCost(undefined);
    const promises = [];
    for (const id of selectedIds) {
      promises.push(
        apiPost({
          path: `${RatingPlanGroup.path}/${id}/simulate_call`,
          values: {
            number: phoneNumber,
            duration,
          },
          contentType: 'application/x-www-form-urlencoded',
          silenceErrors: true,
        })
      );
    }

    Promise.allSettled(promises).then((results) => {
      const successfulResults: SimulateCallResponseType[] = [];
      const errorMessages: string[] = [];

      results.forEach((result, index) => {
        if (result.status === 'fulfilled') {
          successfulResults.push(result.value.data);
        } else {
          const errorDetail = result.reason?.data?.detail;
          if (errorDetail) {
            errorMessages.push(`Plan ID ${selectedIds[index]}: ${errorDetail}`);
          }
        }
      });

      if (successfulResults.length > 0) {
        setCost(successfulResults);
        setError(false);
        setErrorMsg('');
      } else if (errorMessages.length > 0) {
        setError(true);
        setErrorMsg(
          _('No rating plan group can rate a call to introduced destination')
        );
        setCost(undefined);
      }
    });
  };

  const boxStyles = {
    display: 'flex',
    alignItems: 'center',
    alignContent: 'center',
  };

  const customButtons = [
    {
      label: cost ? _('Close') : _('Cancel'),
      onClick: handleClose,
      variant: 'outlined' as const,
      autoFocus: false,
    },
    {
      label: _('Accept'),
      onClick: handleUpdate,
      variant: 'solid' as const,
      autoFocus: true,
      disabled: !!cost || error || !phoneNumber || !duration,
    },
  ];

  return (
    <>
      <a onClick={handleClickOpen}>
        {variant === 'text' && (
          <MoreMenuItem onClick={handleClickOpen}>
            {_('Simulate call')}
          </MoreMenuItem>
        )}
        {variant === 'icon' && (
          <Tooltip
            title={_('Simulate call')}
            placement='bottom'
            enterTouchDelay={0}
          >
            <span>
              <StyledTableRowCustomCta>
                <CurrencyExchangeIcon />
              </StyledTableRowCustomCta>
            </span>
          </Tooltip>
        )}
      </a>
      {open && (
        <>
          <Modal
            open={open}
            onClose={handleClose}
            title={
              <>
                {_('Simulate call')} {cost ? `(${phoneNumber})` : ''}
              </>
            }
            buttons={customButtons}
            keepMounted={true}
            sx={{ textAlign: 'left' }}
          >
            {!error && !cost && (
              <>
                <StyledTextField
                  type='text'
                  required={true}
                  label={_('Phone number')}
                  placeholder='+34987654321'
                  value={phoneNumber}
                  onChange={(event) => {
                    const { value } = event.target;
                    setPhoneNumber(value);
                  }}
                  hasChanged={false}
                />
                <StyledTextField
                  type='number'
                  required={true}
                  label={_('Duration (seconds)')}
                  value={duration}
                  onChange={(event) => {
                    const { value } = event.target;
                    setDuration(parseInt(value, 10));
                  }}
                  hasChanged={false}
                />
              </>
            )}
            {cost && cost.length > 0 && (
              <StyledTable size='small'>
                <TableHead>
                  <TableRow>
                    <TableCell>{_('Plan')}</TableCell>
                    <TableCell>{_('Start time')}</TableCell>
                    <TableCell>{_('Duration')}</TableCell>
                    <TableCell>{_('Destination')}</TableCell>
                    <TableCell>{_('Connection fee')}</TableCell>
                    <TableCell>{_('Interval start')}</TableCell>
                    <TableCell>{_('Price')}</TableCell>
                    <TableCell>{_('Total')}</TableCell>
                  </TableRow>
                </TableHead>
                <TableBody>
                  {cost.map((row, idx) => {
                    const rate = row.rate
                      ? `${row.rate} ${row.currencySymbol} / ${row.ratePeriod}`
                      : '';

                    return (
                      <TableRow key={idx}>
                        <TableCell>{row.plan}</TableCell>
                        <TableCell>{row.callDate}</TableCell>
                        <TableCell>{row.duration}</TableCell>
                        <TableCell>{row.patternName}</TableCell>
                        <TableCell>
                          {row.connectionCharge} {row.currencySymbol}
                        </TableCell>
                        <TableCell>{row.intervalStart}</TableCell>
                        <TableCell>
                          {rate} {rate ? _('Seconds') : ''}
                        </TableCell>
                        <TableCell>
                          {row.totalCost} {row.currencySymbol}
                        </TableCell>
                      </TableRow>
                    );
                  })}
                </TableBody>
              </StyledTable>
            )}
            {error && <ErrorMessageComponent message={errorMsg} />}
          </Modal>
        </>
      )}
    </>
  );
};

export default SimulateCall;
