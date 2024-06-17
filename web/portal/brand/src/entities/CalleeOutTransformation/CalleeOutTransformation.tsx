import EntityInterface from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';

import TransformationRule from '../TransformationRule/TransformationRule';

const CalleeOutTransformation: EntityInterface = {
  ...TransformationRule,
  localPath: `${TransformationRule.path}_calleeout`,
  title: _('Callee Out Transformation', { count: 2 }),
};

export default CalleeOutTransformation;
