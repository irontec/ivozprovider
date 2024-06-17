import { CustomActionsType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';

import SimulateCall from './SimulateCall';

const customAction: CustomActionsType = {
  SimulateCall: {
    action: SimulateCall,
    global: true,
  },
};

export default customAction;
