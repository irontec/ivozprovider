import { CustomActionsType } from '@irontec/ivoz-ui/entities/EntityInterface';

import Rerate from './Rerate';

const customAction: CustomActionsType = {
  Rerate: {
    action: Rerate,
    multiselect: true,
  },
};

export default customAction;
