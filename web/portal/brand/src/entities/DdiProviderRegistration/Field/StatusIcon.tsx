import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { Tooltip } from '@mui/material';

import {
  DdiProviderRegistrationPropertyList,
  DdiProviderRegistrationStatus,
} from '../DdiProviderRegistrationProperties';
import { StyledBadge } from './StyledStatus.styles';

type ScalarRowTypes = DdiProviderRegistrationPropertyList<string | boolean>;
type StatusIconValues = ScalarRowTypes & {
  status?: DdiProviderRegistrationStatus;
};
type StatusIconProps = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<ScalarRowTypes, StatusIconValues>
>;

const StatusIcon: StatusIconProps = (props): JSX.Element | null => {
  const { values } = props;
  const status = values.status;
  let tooltipTitle = _('Inactive');

  if (status?.registered) {
    tooltipTitle = _('Registered');
  } else if (status?.inProgress) {
    tooltipTitle = _('In Progress');
  }

  return (
    <Tooltip title={tooltipTitle} enterTouchDelay={0} placement='right'>
      <StyledBadge
        overlap='circular'
        variant='dot'
        status={values.status}
      ></StyledBadge>
    </Tooltip>
  );
};
export default StatusIcon;
