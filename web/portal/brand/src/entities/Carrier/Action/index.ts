import { CustomActionsType } from '@irontec/ivoz-ui/entities/EntityInterface';

import BalanceOperations from './BalanceOperations';

const customAction: CustomActionsType = {
  BalanceOperations: {
    action: BalanceOperations,
    multiselect: false,
  },
};

export default customAction;
