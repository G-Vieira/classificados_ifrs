ahoy.configure({
  urlPrefix: "",
  visitsUrl: "/tracking/visitas",
  eventsUrl: "/tracking/eventos",
  page: null,
  platform: "Web",
  useBeacon: true,
  startOnReady: true,
  trackVisits: true,
  cookies: true,
  cookieDomain: null,
  headers: {},
  visitParams: {},
  withCredentials: false
});

ahoy.trackAll();