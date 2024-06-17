import { CustomActionsType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';

import BalanceOperations from './BalanceOperations';

const customAction: CustomActionsType = {
  BalanceOperations: {
    action: BalanceOperations,
    multiselect: false,
  },
};

export default customAction;
