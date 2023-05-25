import _ from '@irontec/ivoz-ui/services/translations/translate';
import ArrowLeftIcon from '@mui/icons-material/ArrowLeft';
import ArrowRightIcon from '@mui/icons-material/ArrowRight';
import CallEndIcon from '@mui/icons-material/CallEnd';
import ContentCopyIcon from '@mui/icons-material/ContentCopy';
import DialpadIcon from '@mui/icons-material/Dialpad';
import PhoneInTalkIcon from '@mui/icons-material/PhoneInTalk';
import RingVolumeIcon from '@mui/icons-material/RingVolume';
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableRow,
} from '@mui/material';

import { Calls } from './types';

type ActiveCallsTableProps = {
  calls: Calls;
};

export default function ActiveCallsTable(
  props: ActiveCallsTableProps
): JSX.Element {
  const { calls } = props;

  const sortedCalls = Object.values(calls).sort((a, b) => a.time - b.time);

  const directionStyles = {
    verticalAlign: 'middle',
  };

  const eventStyles = {
    verticalAlign: 'middle',
  };

  const copyButtonStyles = {
    verticalAlign: 'middle',
    cursor: 'pointer',
  };

  const copyTextToClipboard = (text: string): void => {
    if (!navigator.clipboard) {
      return;
    }
    navigator.clipboard.writeText(text).then(
      // eslint-disable-next-line no-console
      () => console.log(`Call id copied: ${text}`),
      // eslint-disable-next-line no-console
      (err) => console.error('Could not copy text', err)
    );
  };

  return (
    <Table size='medium' sx={{ tableLayout: 'fixed' }}>
      <TableHead>
        <TableRow>
          <TableCell align='left' padding='normal'>
            {_('Duration')}
          </TableCell>
          <TableCell align='left' padding='normal'>
            {_('Client')}
          </TableCell>
          <TableCell align='left' padding='normal'>
            {_('Caller')}
          </TableCell>
          <TableCell align='left' padding='normal'>
            {_('Callee')}
          </TableCell>
          <TableCell align='left' padding='normal'>
            {_('Carrier', { count: 1 })}
          </TableCell>
          <TableCell align='left' padding='normal'>
            {_('Options')}
          </TableCell>
        </TableRow>
      </TableHead>
      <TableBody>
        {sortedCalls.map((call) => {
          return (
            <TableRow key={`${call.id}#${call.callId}`}>
              <TableCell>
                {call.direction === 'outbound' && (
                  <ArrowLeftIcon titleAccess='outbound' sx={directionStyles} />
                )}
                {call.direction === 'inbound' && (
                  <ArrowRightIcon titleAccess='inbound' sx={directionStyles} />
                )}
                &nbsp;
                {call.event === 'Trying' && (
                  <DialpadIcon titleAccess={call.event} sx={eventStyles} />
                )}
                {call.event === 'Proceeding' && (
                  <DialpadIcon titleAccess={call.event} sx={eventStyles} />
                )}
                {call.event === 'Early' && (
                  <RingVolumeIcon titleAccess={call.event} sx={eventStyles} />
                )}
                {call.event === 'Confirmed' && (
                  <PhoneInTalkIcon titleAccess={call.event} sx={eventStyles} />
                )}
                {call.event === 'Terminated' && (
                  <CallEndIcon titleAccess={call.event} sx={eventStyles} />
                )}
                &nbsp;
                <span>{call.duration}</span>
              </TableCell>
              <TableCell>{call.company}</TableCell>
              <TableCell>{call.caller}</TableCell>
              <TableCell>{call.callee}</TableCell>
              <TableCell>{call.operator}</TableCell>
              <TableCell>
                <ContentCopyIcon
                  titleAccess='Copy call id into the clipboard'
                  sx={copyButtonStyles}
                  onClick={() => copyTextToClipboard(call.callId)}
                />
              </TableCell>
            </TableRow>
          );
        })}
      </TableBody>
    </Table>
  );
}
