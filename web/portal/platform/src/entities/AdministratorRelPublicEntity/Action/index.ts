import { CustomActionsType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';

import GrantAll from './GrantAll';
import GrantReadOnly from './GrantReadOnly';
import RevokeAll from './RevokeAll';

const customAction: CustomActionsType = {
  GrantAll: {
    action: GrantAll,
    multiselect: true,
  },
  GrantReadOnly: {
    action: GrantReadOnly,
    multiselect: true,
  },
  RevokeAll: {
    action: RevokeAll,
    multiselect: true,
  },
};

export default customAction;
