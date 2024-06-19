import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';

import TransformationRule from '../TransformationRule/TransformationRule';

const CalleeInTransformation: EntityInterface = {
  ...TransformationRule,
  localPath: `${TransformationRule.path}_calleein`,
  title: _('Callee In Transformation', { count: 2 }),
};

export default CalleeInTransformation;
