import ErrorMessageComponent from '@irontec/ivoz-ui/components/ErrorMessageComponent';
import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import {
  StyledTable,
  StyledTableRowCustomCta,
} from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import {
  OutlinedButton,
  SolidButton,
} from '@irontec/ivoz-ui/components/shared/Button/Button.styles';
import {
  ActionFunctionComponent,
  GlobalActionItemProps,
  isSingleRowAction,
} from '@irontec/ivoz-ui/router/routeMapParser';
import { StyledTextField } from '@irontec/ivoz-ui/services/form/Field/TextField/TextField.styles';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import CurrencyExchangeIcon from '@mui/icons-material/CurrencyExchange';
import {
  Box,
  Dialog,
  DialogActions,
  DialogContent,
  DialogTitle,
  TableBody,
  TableCell,
  TableHead,
  TableRow,
  Tooltip,
} from '@mui/material';
import { useState } from 'react';
import { useStoreActions } from 'store';

import RatingProfile from '../RatingProfile';

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
  props: GlobalActionItemProps
) => {
  /* eslint-disable react-hooks/rules-of-hooks */
  if (isSingleRowAction(props)) {
    return <span className='display-none'></span>;
  }

  const { rows, variant = 'icon' } = props;

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
    const promises = [];
    for (const row of rows) {
      promises.push(
        apiPost({
          path: `${RatingProfile.path}/${row.id}/simulate_call`,
          values: {
            number: phoneNumber,
            duration,
          },
          contentType: 'application/x-www-form-urlencoded',
          silenceErrors: true,
        })
      );
    }

    Promise.all(promises)
      .then((values) => {
        setCost(values.map((row) => row.data as SimulateCallResponseType));
      })
      .catch((error) => {
        console.error('error', error);
        setError(true);
        setErrorMsg(error.data.detail || error.data.title);
      });
  };

  const boxStyles = {
    display: 'flex',
    alignItems: 'center',
    alignContent: 'center',
  };

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
        <Dialog open={open} onClose={handleClose} maxWidth='lg' keepMounted>
          <DialogTitle>
            {_('Simulate call')} {cost ? `(${phoneNumber})` : ''}
          </DialogTitle>
          <DialogContent sx={{ textAlign: 'left!important' }}>
            {!error && (
              <>
                {!cost && (
                  <Box>
                    <Box sx={boxStyles}>
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
                    </Box>
                    <Box sx={boxStyles}>
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
                    </Box>
                  </Box>
                )}
                {cost && (
                  <Box>
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
                  </Box>
                )}
              </>
            )}
            {error && <ErrorMessageComponent message={errorMsg} />}
          </DialogContent>
          <DialogActions>
            <OutlinedButton onClick={handleClose}>
              {cost ? _('Close') : _('Cancel')}
            </OutlinedButton>
            {!error && !cost && (
              <SolidButton onClick={handleUpdate} autoFocus>
                {_('Accept')}
              </SolidButton>
            )}
          </DialogActions>
        </Dialog>
      )}
    </>
  );
};

export default SimulateCall;
