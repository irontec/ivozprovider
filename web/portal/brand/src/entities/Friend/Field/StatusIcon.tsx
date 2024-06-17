import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec-voip/ivoz-ui/services/form/Field/CustomComponentWrapper';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import { Tooltip } from '@mui/material';

import { FriendPropertyList } from '../FriendProperties';
import {
  StyledStatusIconArrowForwardIcon,
  StyledStatusIconRotateLeftIcon,
} from './StatusIcon.styles';

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
          {_('Inter client connectivity')}
        </span>
      );
    }

    return (
      <Tooltip title={_('Inter client connectivity')}>
        <StyledStatusIconRotateLeftIcon />
      </Tooltip>
    );
  }

  return <span />;
};

export default withCustomComponentWrapper<FriendPropertyListValues>(StatusIcon);
