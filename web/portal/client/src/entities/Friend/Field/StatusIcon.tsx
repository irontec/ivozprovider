import _ from '@irontec/ivoz-ui/services/translations/translate';
import { Tooltip } from '@mui/material';
import {
  StyledStatusIconArrowForwardIcon,
  StyledStatusIconRotateLeftIcon,
} from './StatusIcon.styles';
import { FriendPropertyList } from '../FriendProperties';
import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';

type FriendPropertyListValues = FriendPropertyList<string | number>;
type StatusIconType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<FriendPropertyListValues>
>;

const StatusIcon: StatusIconType = (props): JSX.Element => {
  const _context = props._context;
  const { directConnectivity } = props.values;
  const writeContext = _context === 'write';

  if (directConnectivity === 'yes') {
    if (writeContext) {
      return (
        <span>
          <StyledStatusIconArrowForwardIcon />
          {_('Direct connectivity')}
        </span>
      );
    }

    return (
      <Tooltip title={_('Direct connectivity')}>
        <StyledStatusIconArrowForwardIcon />
      </Tooltip>
    );
  }

  if (directConnectivity === 'intervpbx') {
    if (writeContext) {
      return (
        <span>
          <StyledStatusIconRotateLeftIcon />
          {_('Inter company connectivity')}
        </span>
      );
    }

    return (
      <Tooltip title={_('Inter company connectivity')}>
        <StyledStatusIconRotateLeftIcon />
      </Tooltip>
    );
  }

  //@TODO POSPONED else RegisterStatus::getLocationStatus
  return <span />;
};

export default withCustomComponentWrapper<FriendPropertyListValues>(StatusIcon);
