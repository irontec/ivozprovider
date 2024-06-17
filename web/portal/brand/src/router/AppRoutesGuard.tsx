import ParsedApiSpecInterface from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
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
    username,
  }: {
    target?: string;
    token?: string;
    username?: string;
  } = qsArgs;

  const impersonate = (target || username) && token;

  if (!loggedIn || impersonate) {
    return <Login target={target} username={username} token={token} />;
  }

  return <AppRoutes {...props} />;
}
