import { styled } from '@mui/styles';
import { Tooltip } from '@mui/material';
import DoneIcon from '@mui/icons-material/Done';
import CloseIcon from '@mui/icons-material/Close';
import EastIcon from '@mui/icons-material/East';
import RestartAltIcon from '@mui/icons-material/RestartAlt';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import {
  RetailAccountPropertyList,
  RetailAccountStatus,
} from '../RetailAccountProperties';

type ScalarRowTypes = RetailAccountPropertyList<string | boolean>;
type StatusIconValues = ScalarRowTypes & { status: Array<RetailAccountStatus> };
type StatusIconProps = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<ScalarRowTypes, StatusIconValues>
>;

const StatusIcon: StatusIconProps = (props): JSX.Element | null => {
  const { _context, values } = props;

  if (_context !== 'read' || !values) {
    return null;
  }

  const iconStyles = { verticalAlign: 'bottom' };
  const iconStyler = () => iconStyles;

  if (values.directConnectivity === 'yes') {
    const StyledIcon = styled(EastIcon)(iconStyler);
    return (
      <Tooltip title={_('Direct connectivity')} enterTouchDelay={0}>
        <StyledIcon />
      </Tooltip>
    );
  }

  if (values.directConnectivity === 'intervpbx') {
    const StyledIcon = styled(RestartAltIcon)(iconStyler);
    return (
      <Tooltip title={_('Inter company connectivity')} enterTouchDelay={0}>
        <StyledIcon />
      </Tooltip>
    );
  }

  if (
    !values.status ||
    !Array.isArray(values.status) ||
    values.status.length === 0
  ) {
    const StyledIcon = styled(CloseIcon)(iconStyler);
    return (
      <Tooltip title={_('Not registered')} enterTouchDelay={0}>
        <StyledIcon />
      </Tooltip>
    );
  }

  const expires = values.status[0].expires;
  const StyledIcon = styled(DoneIcon)(iconStyler);

  return (
    <Tooltip
      title={_('Registered until: {{date}}', { date: expires })}
      enterTouchDelay={0}
    >
      <StyledIcon />
    </Tooltip>
  );
};

export default StatusIcon;
