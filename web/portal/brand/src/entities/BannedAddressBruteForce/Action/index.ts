import { CustomActionsType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';

import Unban from './Unban';

const customAction: CustomActionsType = {
  Unban: {
    action: Unban,
  },
};

export default customAction;
