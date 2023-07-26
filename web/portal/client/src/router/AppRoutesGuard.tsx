import ParsedApiSpecInterface from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import queryString from 'query-string';
import { useStoreState } from 'store';

import Login from '../components/Login';
import AppRoutes from './AppRoutes';

export interface AppRoutesGuardProps {
  apiSpec: ParsedApiSpecInterface;
}

export default function AppRoutesGuard(props: AppRoutesGuardProps) {
  const loggedIn = useStoreState((state) => state.auth.loggedIn);
  const qsArgs = queryString.parse(location.search);
  const {
    target,
    token,
  }: {
    target?: string;
    token?: string;
  } = qsArgs;

  if (!loggedIn || (target && token)) {
    return <Login target={target} token={token} />;
  }

  return <AppRoutes {...props} />;
}
